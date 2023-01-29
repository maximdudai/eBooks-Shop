<?php
    include('footer-style.php');
?>

<div class="footer">
    <div class="container text-center">
        <div class="row d-flex justify-content-between align-items-center justify-content-center">
            <div class="col-md-5" id="ebook-logo">
                <img class="img-fluid ebook-img" src="https://cdn-icons-png.flaticon.com/512/1945/1945963.png" alt="ebook-logo">
            </div>
            <div class="col-md-5">
                
                <div class="location-icon">
                    <div class="map-icon">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-geo-alt-fill"></i>
                        </button>    
                    </div>

                    <div class="address">
                        <ul>
                            <li>
                                <a href="tel:+351123456789">(+351) 123 456 789</a>
                            </li>
                            <li>
                                <a href="mailto:invalidmail@gmail.com">invalidmail@gmail.com</a>
                            </li>
                            <li>
                                <a href="#">C. C. Alegro Alfragide - Av dos Cavaleiros</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- popup when click a location icon -->
<section class="location-modal">
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content d-flex justify-content-center align-items-center">
            <div class="modal-body">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49784.66253843576!2d-9.20240225238089!3d38.751284549023325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1ecdca0be703d3%3A0x38b1d71128e15bb!2sPal%C3%A1cio%20Nacional%20e%20Jardins%20de%20Queluz!5e0!3m2!1spt-PT!2spt!4v1663518564056!5m2!1spt-PT!2spt" width="450" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>    
                <p class="text-center">
                    (+351) 123 456 789 <br />
                    invalidmail@gmail.com <br />
                    C. C. Alegro Alfragide - Av dos Cavaleiros
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>