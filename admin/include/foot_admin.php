 <!-- Modal Start -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog  modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-body">
                 <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                 <p>Are you sure you want to log out?</p>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                 <div class="button-box">
                     <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                     <a href="logout.php" class="btn  btn--yes btn-primary">Yes</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Modal End -->

 <!-- Delete Modal Box Start -->
 <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle" aria-hidden="true" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header d-block text-center">
                 <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <i class="fas fa-times"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="remove-box">
                     <p>The permission for the use/group, preview is inherited from the object, object will create a
                         new permission for this object</p>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                 <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true" tabindex="-1">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                     <i class="fas fa-times"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="remove-box text-center">
                     <div class="wrapper">
                         <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                             <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                             <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                         </svg>
                     </div>
                     <h4 class="text-content">It's Removed.</h4>
                 </div>
             </div>
             <div class="modal-footer">
                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <!-- Delete Modal Box End -->

 <!-- latest js -->
 <script src="assets/js/jquery-3.6.0.min.js"></script>

 <!-- Bootstrap js -->
 <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

 <!-- feather icon js -->
 <script src="assets/js/icons/feather-icon/feather.min.js"></script>
 <script src="assets/js/icons/feather-icon/feather-icon.js"></script>

 <!-- scrollbar simplebar js -->
 <script src="assets/js/scrollbar/simplebar.js"></script>
 <script src="assets/js/scrollbar/custom.js"></script>

 <!-- Sidebar jquery -->
 <script src="assets/js/config.js"></script>

 <!-- tooltip init js -->
 <script src="assets/js/tooltip-init.js"></script>

 <!-- Plugins JS -->
 <script src="assets/js/sidebar-menu.js"></script>
 <!-- <script src="assets/js/notify/bootstrap-notify.min.js"></script>
<script src="assets/js/notify/index.js"></script> -->

 <!-- Apexchar js -->
 <script src="assets/js/chart/apex-chart/apex-chart1.js"></script>
 <script src="assets/js/chart/apex-chart/moment.min.js"></script>
 <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
 <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
 <script src="assets/js/chart/apex-chart/chart-custom1.js"></script>

 <!-- Data table js -->
 <script src="assets/js/jquery.dataTables.js"></script>
 <script src="assets/js/custom-data-table.js"></script>

 <!-- slick slider js -->
 <script src="assets/js/slick.min.js"></script>
 <script src="assets/js/custom-slick.js"></script>

 <!-- customizer js -->
 <!-- <script src="assets/js/customizer.js"></script> -->

 <!-- ratio js -->
 <script src="assets/js/ratio.js"></script>

 <!-- sidebar effect -->
 <script src="assets/js/sidebareffect.js"></script>

 <!-- all checkbox select js -->
 <script src="assets/js/checkbox-all-check.js"></script>

 <!-- Theme js -->
 <script src="assets/js/script.js"></script>


 <!-- bootstrap tag-input js -->
 <script src="assets/js/bootstrap-tagsinput.min.js"></script>


 <!--Dropzon js -->
 <script src="assets/js/dropzone/dropzone.js"></script>
 <script src="assets/js/dropzone/dropzone-script.js"></script>


 <!-- select2 js -->
 <script src="assets/js/select2.min.js"></script>
 <script src="assets/js/select2-custom.js"></script>

 <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('editor', {
      // Configuration options can be added here
    });
  </script>