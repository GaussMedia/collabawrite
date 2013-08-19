<html>
<head>
<script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> 
<script type="text/javascript" language="javascript">
var tmpText = '';
$(document).ready(function(){
        tmpText = '';
        $('#btn_bold').click(function(){alert(tmpText);});
        $('textarea').bind('mouseup', function(){
                  tmpText = '';
                  if(window.getSelection){
                    tmpText = window.getSelection();
                  }else if(document.getSelection){
                    tmpText = document.getSelection();
                  }else if(document.selection){
                    tmpText = document.selection.createRange().text;
                  }
                //tmpText = 'hello world';
                alert(tmpText);
        });
});

</script>
</head>
<body>
<button type="button" id="btn_bold">click</button>
<textarea>This is some text</textarea>
<a id="b" class="btn" target="_blank" href="https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fsupport.twitter.com%2Farticles%2F78124-posting-links-in-a-tweet&text=Twitter%20Help%20Center%20%7C%20Posting%20links%20in%20a%20Tweet&tw_p=tweetbutton&url=https%3A%2F%2Fsupport.twitter.com%2Farticles%2F78124-posting-links-in-a-tweet&via=support">
<i></i>
<span id="l" class="label">Tweet</span>
</a>
</body>
</html>