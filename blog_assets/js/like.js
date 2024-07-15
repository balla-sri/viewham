	    $(document).ready(function () {

// like and unlike click
        $(".like").click(function () {
            var sess = $('#session_exist').val();
            if(sess == 0){
                $('#signinModal').modal('toggle');
            }else{
               
            
            var id = this.id;   // Getting Button id
            var split_id = id.split("_");

            var text = split_id[0];
            var postid = split_id[1];  // postid

// Finding click type
            var type = '';
            if (text == "like") {
                type = 1;

            } else {
                type = 0;

            }

// AJAX Request
            $.ajax({
                url: '/Learn/itemLike',
                type: 'post',
                data: {postid: postid, type: type},
                success: function (response) {

                    if (type == 1) {
                        $("#like_" + postid).css("color", "#4080ff");
                        $("#like_" + postid).attr("id", "unlike_" + postid);

                    }

                    if (type == 0) {
                        $("#unlike_" + postid).css("color", "#616770");
                        $("#unlike_" + postid).attr("id", "like_" + postid);

                    }
                }

            });
        }
        });

    });
