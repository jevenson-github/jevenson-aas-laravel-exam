@extends('layout.main'); 
@section('position')
      <div class="container mt-5">
            <div class="row mb-5"> 
                <div class="col-6">
                    <h2>Position Management</h2>
                </div>
               <div class="col-6 text-end">
                    <button type="button" class="btn btn-primary btn-addPosition" data-bs-toggle="modal" data-bs-target="#addPositionModal">Add Position</button>
               </div> 
            </div>

            <form name="filter_form">
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Search</label>
                            <input name="q" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Sort By</label>
                            <select name="sort_order" class="form-control">
                                <option value="asc" selected>Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                        
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Apply</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
            
            {{-- Div rendering position's list --}}
            <div id="position-list">
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                        <th scope="col" class="text-center">Position</th>
                        <th scope="col" class="text-center">Reports To</th>  
                        <th scope="col" class="text-center">Action </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
      </div> 

{{-- MODAL FOR EDIT  --}}
      <div class="modal fade" id="editPositionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Position</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                   
    
                <div class="container">
                    <div class="col-12">  
    
    
                        <div class="mb-3">
                          <label for="position_name" class="form-label ">Position Name</label>
                          <input type="text" class="form-control" id="position-name-edit" placeholder="name" autocomplete="off">
          
                          <div class="text-danger d-none name-validation-edit">
                              Please select a valid state.
                            </div>
                      </div> 
                 
                      </div> 
    
                      <div class="col-12">
                        <div class="mb-5">
                            <label for="reports-to-list" class="form-label ">Reports To</label> 
            
                            <select class="form-select" aria-label="Default select example" id="reports-to-list-edit" name="selectoption">
                              </select>
            
                            <div class="text-danger d-none reports-to-validation-edit">
                                Please select a valid state.
                              </div>
                        </div> 
                    </div>
            
                </div>
                   
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary edit-position">Update Position</button>
    
            </div>
          </div>
        </div>
      </div>

{{-- MODAL FOR ADD POSITIONS --}}
 <div class="modal fade" id="addPositionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Position</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
               

            <div class="container">
                <div class="col-12">  


                    <div class="mb-3">
                      <label for="position_name" class="form-label ">Position Name</label>
                      <input type="text" class="form-control" id="position_name" placeholder="name" autocomplete="off">
      
                      <div class="text-danger d-none name-validation">
                          Please select a valid state.
                        </div>
                  </div> 
             
                  </div> 

                  <div class="col-12">
                    <div class="mb-5">
                        <label for="reports-to-list" class="form-label ">Reports To</label> 
        
                        <select class="form-select" aria-label="Default select example" id="reports-to-list">
                          </select>
        
                        <div class="text-danger d-none description-validation">
                            Please select a valid state.
                          </div>
                    </div> 
                </div>
        
            </div>
               
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary submit-position" >Save Position</button>

        </div>
      </div>
    </div>
  </div>

 {{-- MODAL FOR VIEW DETAILS  --}}
 <div class="modal fade" id="viewPositionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Position Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                
                <div class="row">
                    <div class="col"> 
                        <div class="mb-5">
                        <label for="position_name" class="form-label  ">Name : </label>
                        <h4 class="positionName"></h4>
                    </div> 
                </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="reports_to" class="form-label">Reports To: </label>
                            <h4 class="reportsTo"></h4>
                        </div> 
                    </div>
                </div>
         
        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
        </div>
     

        @endsection






@section('script') 
   <script>   
 // Set Dropdown Values on Edit 
 function setDropDownListOnEdit(){
    $.ajax({
                type: "GET",
                url: "/api/position",
                success: function (response) {
                    var report_to_list = response.data; 
                    var $dropdown = $('#reports-to-list-edit');

                    $dropdown.empty(); 
                    $dropdown.append('<option value="">Select a position</option>');
                   
                    // loop 
                    $.each(report_to_list, function (index, value) { 
                    var $option = `<option value="${value.id}">${value.position_name}</option>`;
                    $dropdown.append($option); // Append directly to the dropdown
                });

                }

            });
   }
 
//Get Positions
function getPositions () {  
    
    var q = $('input[name="q"]').val();
    var sort_order = $('select[name="sort_order"]').val();
         
    var $table = $('#position-list');
    
    $.ajax({
        type: "GET",
        url: "/api/position",
        dataType: 'json',
        data: {
            q: q,
            sort_order: sort_order
        },
        beforeSend: function () {
            $table.find('tbody').html('')
        },
        success: function (response) {

            var position_list = response.data
            var $tablemain = $("#myTable"); 
            // loop 
            $.each(position_list, function (index, value) { 
                var $row = `<tr>
                    <td>${value.position_name}</td>    
                    <td>${value.reports_to}</td>    
                    <td class="text-center"> 
                        <button type="button" data-id="${value.id}" class="btn btn-view btn-info">View</button>
                        <button type="button" data-id="${value.id}" class="btn btn-edit btn-primary">Edit</button>
                        <button type="button" data-id="${value.id}" class="btn btn-delete btn-danger">Delete</button>
                    </td>    
                </tr>`

                $table.find('tbody').append($row);   

            }); 
        },
        complete: function () {

        }
    });  

}
// View Details 
function viewPositionDetails(id){
            var position_id = id; 

            $.ajax({
                type: "GET",
                url: "/api/position/"+ position_id,
                success: function (response) { 
                        $('.positionName').text(response.data.position_name); 
                        $('.reportsTo').text(response.data.reports_to); 
                }
            });
            // Show Modal
            $("#viewPositionModal").modal('show'); 
        }
// Delete
  function deletePosition(id){
            var position_id = id; 

            $.ajax({
                type: "DELETE",
                url: "/api/position/"+position_id,
                success: function (response) { 
                    
                        Swal.fire({ 
                        position: "top-end",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500 

                        }) .then( function(){
                                 location.reload();
                        }); 
                }
            });
        }    

// Update 
    function updatePosition(id){

            var position_id = id; 
            // Show Modal
            $("#editPositionModal").modal('show');  

            $.ajax({
                type: "GET",
                url: "/api/position/"+position_id,
                success: function (response) { 
                   
                        $('#position-name-edit').val(response.data.position_name);   
                        // set's default value to select option 
                        $('select[name="selectoption"] option[value="'+ response.data.reports_to_id +'"]').attr('selected', 'selected');
                }
            });  


            $(document).on('click', '.edit-position', function (e) { 

                var position_id = id;

                var reports_to_value =  $('#reports-to-list-edit').val(); 
                var position_name_value =  $('#position-name-edit').val(); 

            let formData = {
               position_name : position_name_value , 
               reports_to_id : reports_to_value
            } 
            

             $.ajax({ 
                type: "PUT",
                url: "/api/position/"+position_id,
                data: JSON.stringify(formData),
                contentType: "application/json", 
                success: function (response) {

                    Swal.fire({ 

                        position:"top-end",
                        icon: "success",
                        title: "Position Successfuly Updated",
                        showConfirmButton: false,
                        timer: 1500 

                        }) .then( function(){
                            // location.reload();
                        });  
                }  
                ,error:function(xhr){   

                            let error = xhr.responseJSON;  
                             
                                if(error.errors.position_name ){
                                    $( ".name-validation-edit" ).removeClass( "d-none" ).text(error.errors.position_name);
                                    $(" #position-name-edit").addClass('border border-danger');  

                                } 
                                
                                if(error.errors.reports_to_id){
                                    $( ".reports-to-validation-edit" ).removeClass( "d-none" ).text(error.errors.reports_to_id);
                                    $(" #reports-to-list-edit").addClass('border border-danger');
                                }



                     }  
             });
            })

        }

// On load Display 
$(document).ready(function () {

            // Get All Positions on page load
            getPositions(); 

            // On click of View Button
            $(document).on('click', '.btn-view', function (e) {
                var $this = $(this);
                var position_id = $this.data('id')
                viewPositionDetails(position_id)
            })

            // On click of Edit Button
            $(document).on('click', '.btn-edit', function (e) {
                var $this = $(this);
                var position_id = $this.data('id')
                updatePosition(position_id)
            })


            // On Click of Delete Button
            $(document).on('click', '.btn-delete', function (e) {
                var $this = $(this);
                var position_id = $this.data('id')
                deletePosition(position_id)
            }) 

            $('form[name="filter_form"]').on('submit', function (e) {
                e.preventDefault();
                getPositions();
            })

            // Set values on Dropdown Edit
            setDropDownListOnEdit(); 

        });
   
      
// Set dropdown values 
$(".btn-addPosition").click(function() { 
            //Populate the dropdown . 
            $.ajax({
                type: "GET",
                url: "/api/position",
                success: function (response) {

                    var report_to_list = response.data; 
                    var $dropdown = $('#reports-to-list');

                    $dropdown.empty(); 
                    $dropdown.append('<option value="">Select a position</option>');
                   
                    // loop 
                    $.each(report_to_list, function (index, value) { 
                    var $option = `<option value="${value.id}">${value.position_name}</option>`;
                    $dropdown.append($option); // Append directly to the dropdown
                });

                }

            });
        }); 
  

// Submit Position Details 
$(".submit-position").click(function() {  

            var reports_to_value =  $('#reports-to-list').val(); 
            var position_name_value =  $('#position_name').val(); 

            let formData = {
               position_name : position_name_value , 
               reports_to_id : reports_to_value
            } 
            
            $.ajax({ 

                type: "POST",
                url: "/api/position",
                data: JSON.stringify(formData),
                contentType: "application/json",
                success: function (response) {
                
                    // Hide modal after success 
                     $('#addPositionModal').modal('hide'); 
                       
                    Swal.fire({ 

                    position: "top-end",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500 

                     }) .then( function(){
                        $('#position_name').val(''); 
                        location.reload();
                     }); 
                    } 
                    
                    ,error:function(xhr){  
                            let error = JSON.parse(xhr.responseText);  

                                if(error.errors.position_name){
                                    $( ".name-validation" ).removeClass( "d-none" ).text(error.errors.position_name);
                                     $(" #position_name").addClass('border border-danger'); 
                                }


                     }  
                     
                
            });

        }); 




</script> 


@endsection