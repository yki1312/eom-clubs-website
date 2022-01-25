        
            <footer class="earlFooter">
                <div class="container">
                    <h3>EARL OF MARCH SS</h3>
                    <address style="padding: 15px;">
                        4 The Parkway, Kanata, ON K2K 1Y4, <br>
                        Phone (613) 592-3361 | Fax (613) 592-9501 <br>
                        <a href="mailto:earlofmarchss@ocdsb.ca">Email: earlofmarchss@ocdsb.ca</a>
                    
            <div style="display:flex;justify-content:flex-end;margin-top:auto;">
            
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
            </div>
            </address>
            
        </footer>
            </div>
        <?php mysqli_close($conn); ?>
        </body>

        </html>