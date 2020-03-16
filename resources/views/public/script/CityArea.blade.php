<script>

$('#loading').hide();

  $("#city").on('change',function() {





   var cityname = $(this).val();



        $.ajax({
          beforeSend: function(){
            $('#loading').show();
},

          type:"get",
             url:"/getAreas/"+cityname, //Please see the note at the end of the post**
             success:function(res)
             {
               if(res)
               {


                   $("#area").empty();
                   $("#area").append('<option value="">Select Area</option>');

                   $.each(res,function(key,branch){



                        $("#area").append('<option value="'+branch.area+'">'+branch.area+'</option>');





                   });
                     $('#area').formSelect();
               }
          },
          complete:function(){
            $('#loading').hide();
            }
        }); //ajax end

   })
</script>
