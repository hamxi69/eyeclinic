$(document).ready(function(){
  function getUser(){
    $.ajax({
      type:"GET",
      url:"get_user1.php",
      dataType:"json",
      success: function(data){

        $('#navName').text(data.userfullname);
        $('#profileName').text(data.userfullname);
        $('#CIDName').text(data.userclinicname);
        $('#profilename').text(data.userfullname);
        $('#profileCid').text(data.userclinicname);
        $('#overviewName').text(data.userfullname);
        $('#overviewEmail').text(data.useremail);
        $('#overviewAddress').text(data.useraddress);
        $('#overviewContact').text(data.userrole);
      },
      complete: function() {
        setTimeout(getUser, 5000);
      }
    });
  }
  getUser();
})