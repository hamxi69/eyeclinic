$(document).ready(function(){
    $('#resetform1').on('click',function(){
      $('#edtcnicerr').text('');
      $('#edtcontacterr').text('');
    });
    });
  $(document).ready(function(){
    $('#resetform').on('click',function(){
      $('#newappointment').html('');
      $('#detail').html('')
      $('#appointid').html('');
      $('#cnicerr').text('');
      $('#contacterr').text('');
    });
  });
  $(document).ready(function(){
    $('#patientContact').on('input',function(){
      $('#contacterr').text('');
    });
  });
  $(document).ready(function(){
    $('#edtpatientContact').on('input',function(){
      $('#edtcontacterr').text('');
    });
  });
  $(document).ready(function(){
    $('#patientCnic').on('input',function(){
      $('#cnicerr').text('');
    });
  });
  $(document).ready(function(){
    $('#edtpatientCnic').on('input',function(){
      $('#edtcnicerr').text('');
    });
  });

$('#add_patient').submit(function(event){
event.preventDefault();
var clinic_id      = $('#clinicid').val();
var patient_name   = $('#patientName').val();
var patient_address= $('#patientAddress').val();
var patient_Contact= $('#patientContact').val();
var patient_cnic   = $('#patientCnic').val();
var patient_age    = $('#patientAge').val();
var patient_gender = $('input[name="patientradiobtn"]:checked').val();

var contact_regex = /^03\d{9}$/;
var cnicRegex = /^\d{13}$/;
var error = false;
  if (!contact_regex.test(patient_Contact)) {
    // Show error message if the format is not matched
    $('#contacterr').text('Invalid contact format. It should be in the format 03XXXXXXXXX.');
      error=true;
  }
  if (!cnicRegex.test(patient_cnic)) {
    // Show error message if the format is not matched
    $('#cnicerr').text('Invalid Cnic format. It should be in the format 4210112345671.');
      error=true;
  }

  if (error){
    return;
  }

$.ajax({
    
  type:'post',
  url:'action.php',
  data: 
  {
    'patientSubmit':true,
    'clinic_name':clinic_id,
    'patient_name':patient_name,
    'patient_contact':patient_Contact,
    'patient_cnic':patient_cnic,
    'patient_address':patient_address,
    'patient_age':patient_age,
    'patient_gender':patient_gender,

  },
  dataType: 'json',
  success:function(response){
    if (response.success) {
      $('#addClinic').modal('hide');
        $('#msg').html('<div class="alert alert-success  align-items-center" style="float:right;"><strong>' + response.message + '<strong></div>');
        setTimeout(function(){
          $('#msg').html('');
        }, 3000);
      $('#patientName').val('');
      $('#patientAddress').val('');
      $('#patientContact').val('');
      $('#patientCnic').val('');
      $('#patientAge').val('');
      $('#patientmale').prop('checked', false);
      $('#patientfemale').prop('checked', false);
      $('#detail').html('')
      $('#appointid').html('');
      $('#newappointment').html('');

      } else {
        $('#error').text(response.message);
      }
  }
});
});
$('#patientContact').on('blur', function(){
    var patient_contact = $(this).val();
    $.ajax({
        url: 'check_patient.php',
        type: 'post',
        data: {patient_contact:patient_contact},
        success: function(response){
          var data = JSON.parse(response);
            if(data.patient_name){
                $('#patientName').val(data.patient_name);
                $('#patientCnic').val(data.patient_cnic);
                $('#patientAddress').val(data.patient_address);
                $('#patientAge').val(data.patient_age);
                $('#clicnicSelect').val(data.patient_clinic);
                if(data.patient_gender=='Male'){
                  $('#patientmale').prop('checked', true);
                }else if(data.patient_gender=='Female'){
                  $('#patientfemale').prop('checked', true);
                }else{
                  $('#patientmale').prop('checked', false);
                  $('#patientfemale').prop('checked', false);
                }
                $('#detail').html('<div class="text-primary" style="font-size:15px;font-weight:800" >Last Visit: <span class="text-dark">'+ data.patient_lastvisit +'</span></div>');
                $('#appointid').html('<div class="text-primary" style="font-size:15px;font-weight:800" >Last Appointment Id: <span class="text-dark">'+ data.patient_appointid +'</span></div>');
                $('#newappointment').html('');
              }
            else{
              $('#newappointment').html('<div class="text-primary" style="font-size:15px;font-weight:800" ><span class="text-dark">'+ data.message +'</span></div>');
              $('#detail').html('')
              $('#appointid').html('');
              $('#patientName').val('');
              $('#patientAddress').val('');
              $('#patientAge').val('');
              $('#patientCnic').val('');
              $('#clicnicSelect').val($('#clicnicSelect').data('clinic-name'));
              $('#patientmale').prop('checked', false);
              $('#patientfemale').prop('checked', false);
            }
        }
    });
});
// $('#patientCnic').on('blur', function(){
//     var patient_cnic = $(this).val();
//     $.ajax({
//         url: 'check_patient.php',
//         type: 'post',
//         data: {patient_cnic:patient_cnic},
//         success: function(response){
//           var data = JSON.parse(response);
//               if(data.patient_name){
//                 $('#patientName').val(data.patient_name);
//                 $('#patientContact').val(data.patient_contact);
//                 $('#patientAddress').val(data.patient_address);
//                 $('#patientAge').val(data.patient_age);
//                 $('#clicnicSelect').val(data.patient_clinic);
//                 if(data.patient_gender=='Male'){
//                   $('#patientmale').prop('checked', true);
//                 }else if(data.patient_gender=='Female'){
//                   $('#patientfemale').prop('checked', true);
//                 }else{
//                   $('#patientmale').prop('checked', false);
//                   $('#patientfemale').prop('checked', false);
//                 }
//                 $('#detail').html('<div class="text-primary" style="font-size:15px;font-weight:800" >Last Visit: <span class="text-dark">'+ data.patient_lastvisit +'</span></div>');
//                 $('#appointid').html('<div class="text-primary" style="font-size:15px;font-weight:800" >Last Appointment Id: <span class="text-dark">'+ data.patient_appointid +'</span></div>');
//                 $('#newappointment').html('');
                
//             }else{
//               $('#newappointment').html('<div class="text-primary" style="font-size:15px;font-weight:800" ><span class="text-dark">'+ data.message +'</span></div>');
//               $('#detail').html('')
//               $('#appointid').html('');
//               $('#patientName').val('');
//               $('#patientAddress').val('');
//               $('#patientAge').val('');
//               $('#clicnicSelect').val('');
//               $('#patientmale').prop('checked', false);
//               $('#patientfemale').prop('checked', false);
//             }
//         }
//     });
// });


$(document).ready(function() {
  function getData() {
    $.ajax({
      type: "GET",
      url: "get_appointment.php",
      dataType: "json",
      success: function(data) {

        $('#table-body').html('');

        data.forEach(function(record) {
           var genderBadge = record.patient_gender =='Male' ? '<span class="badge bg-primary"><i class="bi bi-gender-male"></i>Male</span>' : '<span class="badge bg-danger"><i class="bi bi-gender-female"></i>Female</span>';
            var newRow = '<tr>' +
            '<td>' + record.id + '</td>' +
            '<td>' + record.patient_name + '</td>' +
            '<td>' + record.patient_address + '</td>' +
            '<td>' + record.patient_contact + '</td>' +
            '<td>' + record.patient_cnic + '</td>' +
            '<td>' + record.patient_age + '</td>' +
            '<td>' + genderBadge + '</td>' +
            '<td>' + record.patient_appoint + '</td>' +
            '<td>' +
            '<button class="editbtn btn btn-sm btn-dark tblbtn"  name="edtpatientSubmit" data-edit-id="'+ record.id +'"><i class="bi bi-pencil-square"></i></button>' +
            '<button class="delete btn btn-sm btn-danger tblbtn" name="deletepatient" data-delete-id="' + record.id + '"><i class="bi bi-trash"></i></button>' +
            '</td>' +
            '</tr>';

          $('#table-body').append(newRow);
        }
        );
        $('.delete').on('click', function (){

          var delete_patientId = $(this).data('delete-id');
           // console.log(id);
          
          $.ajax({
            type :'post',
            url  :'action.php',
            data :
            {
              'deletepatient':true,
              'delete-id':delete_patientId
            },
            dataType: 'json',
            success:function(response)
            {
            if (response.success)
             {
             $('#msg').html('<div class="alert alert-danger  align-items-center" style="float:right;"><strong>' + response.message + '<strong></div>');
            setTimeout(function()
            {
            $('#msg').html('');
            }, 3000);
           } 
            else 
           {
            $('#error').text(response.message);
          }
          }
          });

        });
        $('.editbtn').on('click', function(){
            $('#editmodal').modal('show');
            var edit = $(this).data('edit-id');

            $tr=$(this).closest('tr');
            var data= $tr.children("td").map(function(){
              return $(this).text();
            }).get();
            console.log(data);
            $('#editpatientid').val(data[0]);
            $('#edtpatientName').val(data[1]);
            $('#edtpatientContact').val(data[3]);
            $('#edtpatientCnic').val(data[4]);
            $('#edtpatientAddress').val(data[2]);
            $('#edtpatientAge').val(data[5]);
            if(data[6]=="Male"){
                  $('#edtpatientmale').prop('checked', true);
                }else if(data[6]=="Female"){
                  $('#edtpatientfemale').prop('checked', true);
                }else{
                  $('#edtpatientmale').prop('checked', false);
                  $('#edtpatientfemale').prop('checked', false);
                }
            $('#edt_patient').submit(function(event){
              event.preventDefault();
              var patient_id      = $('#editpatientid').val();
              var patient_name   = $('#edtpatientName').val();
              var patient_address= $('#edtpatientAddress').val();
              var patient_Contact= $('#edtpatientContact').val();
              var patient_cnic   = $('#edtpatientCnic').val();
              var patient_age    = $('#edtpatientAge').val();
              var patient_gender = $('input[name="edtpatientradiobtn"]:checked').val();

              var contact_regex = /^03\d{9}$/;
              var cnicRegex = /^\d{13}$/;
              var error = false;
                if (!contact_regex.test(patient_Contact)) {
                  $('#edtcontacterr').text('Invalid contact format. It should be in the format 03XXXXXXXXX.');
                    error=true;
                }
                if (!cnicRegex.test(patient_cnic)) {
                  $('#edtcnicerr').text('Invalid Cnic format. It should be in the format 4210112345671.');
                    error=true;
                }

                if (error){
                  return;
                }

            $.ajax({
                type:'post',
                url:'action.php',
                data:
                {
                  'edtpatientSubmit'   : true,
                  'edit-id'            : patient_id,
                  'edtpatient_name'    : patient_name,
                  'edtpatient_contact' : patient_Contact,
                  'edtpatient_address' : patient_address,
                  'edtpatient_cnic'    : patient_cnic,
                  'edtpatient_age'     : patient_age,
                  'edtpatient_gender'  : patient_gender
                },
                dataType: 'json',
                success:function(response)
            {
            if (response.success)
             {
              $('#editmodal').modal('hide');

             $('#msg').html('<div class="alert alert-warning  align-items-center" style="float:right;"><strong>' + response.message + '<strong></div>');
            setTimeout(function()
            {
            $('#msg').html('');
            }, 3000);
           } 
            else 
           {
            $('#erroredit').text(response.message);
          }
          
        }
            });
              
            });

          });

      },
      complete: function() {
        setTimeout(getData, 2000);
      }
    });
  }

  getData();
});