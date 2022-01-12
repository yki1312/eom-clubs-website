<?php include_once 'header.php'; ?>

    <section class="flex-container-h">
        <div class="flex-container-v" style="flex-grow: 1;">
            <h1 style="font-size: xx-large;">EARL OF MARCH CLUBS</h1>
            <p>This is a website specially designed for the students who would like to participate in clubs which are held at Earl of March. <br>
            It makes the information for the students more condensed and makes it easier to access the information of the different clubs. <br>
            ~ Earl Of March Secondary School</p>
        </div>


            
        <div style="flex-grow: 1;">
            <h2>Photo gallery.</h2>
            <img id="myImg" src="img/Earl.png" alt="Earl of March Secondary School"  style="width:100%;max-width:300px">
            
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
            </div>

            <script>
                // Get the modal
                var modal = document.getElementById("myModal");
                
                // Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.getElementById("myImg");
                var modalImg = document.getElementById("img01");
                var captionText = document.getElementById("caption");
                img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
                }
                
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() { 
                modal.style.display = "none";
                }
            </script>
        </div>
    </section>


<?php include_once 'footer.php'; ?>