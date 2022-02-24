// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('b43fe26aa93e13911707', {
  cluster: 'mt1'
});

var channel = pusher.subscribe('my-channel');

channel.bind('my-event', function(data) {

    // alert(JSON.stringify(data));

    let id =   JSON.parse(data.message);
    let newid = JSON.parse(data.newid);
    
  $.ajax({
    url: "Mamanage-Users-Test.php",
    type: "POST",
    data: {
      CurrentUserId: id , 
      newcurrentuserid : newid
    },
    success: function(result){
    $("#div1").html(result);

  }});

});