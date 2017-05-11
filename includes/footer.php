<!--Footer-->
<br><br><br><br><br>
<footer class="footer">
    <div class="container-fluid" style="text-align: center;">
        <p class="text-muted">Copyright © <?php echo date("Y")?> Donald R. Schwartz and Marist College. All rights reserved.</p>
    </div>
</footer>
<script>
var code = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];

var othercode = [72, 69, 65, 68, 79, 70, 68, 79, 78];

var pos = 0;

var otherpos = 0;
document.addEventListener('keydown', function(event) {
    if(event.keyCode == code[pos]) {
        pos++;
        if(pos == code.length){
            window.location.href = "subhome.php";
        }
    }
    else{
        pos = 0;
    }
});

document.addEventListener('keydown', function(event) {
    if(event.keyCode == othercode[otherpos]) {
        otherpos++;
        if(otherpos == othercode.length){
            window.location.href = "subsubhome.php";
        }
    }
    else{
        otherpos = 0;
    }
});


</script>