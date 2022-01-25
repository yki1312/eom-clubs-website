<?php include_once 'header.php'; ?>

    <div class="container">
        <section class="flex-container-h">
            <div class="flex-container-v" style="flex-grow: 1;">
                <h1 style="font-size: xx-large;">EARL OF MARCH CLUBS</h1>
                <p>This is a website specially designed for the students who would like to participate in clubs which are held at Earl of March. <br>
                It makes the information for the students more condensed and makes it easier to access the information of the different clubs. <br>
                ~ Earl Of March Secondary School</p>
            </div>


            <!-- This is the code used to create a model image for the school's photo. 
            A modal is a dialog box/popup window that is displayed on top of the current page. 
            This code is inspired from W3 Schools. -->    
            <div style="flex-grow: 1;">
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

                <!-- This code block is executing the how to convert the image inside the model. 
                It also untilizes the alt text as the caption of the image. -->
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

                <img id="myImg1" src="img/earl_photo.png" alt="Earl of March Logo"  style="width:100%;max-width:300px">

                <!-- The Modal -->
                <div id="myModal2" class="modal2">
                    
                    <!-- The Close Button -->
                    <span class="close2">&times;</span>

                    <!-- Modal Content (The Image) -->
                    <img class="modal-content" id="img02">

                    <!-- Modal Caption (Image Text) -->
                    <div id="caption2"></div>
                </div>

                <script>
                    // Get the modal
                    var modal = document.getElementById("myModal2");
                    
                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                    var img = document.getElementById("myImg1");
                    var modalImg = document.getElementById("img02");
                    var captionText = document.getElementById("caption2");
                    img.onclick = function(){
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                    }
                    
                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close2")[0];
                    
                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() { 
                    modal.style.display = "none";
                    }
                </script>

            </div>
        </section>
    </div>
<br>
<br>

<?php include_once 'footer.php'; ?>