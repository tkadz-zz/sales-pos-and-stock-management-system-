

</div> <!-- Begin Page Content Starts in Navbar -->
</div> <!-- Main Content Starts in Navbar-->



<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span></span>
            <span>
                <?php
                $n = new DefaultView();
                $n->viewWebFooter();
                ?>
                <br>
                Copyright &copy;
                <?php
                $n->viewWebFullName();
                ?>

                <?php
                $n->viewWebYear();
                ?>

            </span>
        </div>
    </div>
</footer>
<!-- End of Footer -->



</div> <!-- Content Wrapper Starts in Navbar-->
</div> <!-- Page Wrapper Ends, Starts in Header-->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="?logout=true">Logout</a>
            </div>
        </div>
    </div>
</div>





<!-- Add User Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="addUserModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="../includesDefault/add.inc.php">
                <div class="modal-body">
                    <div class="-modal-header">
                        <h5>Add New User</h5>
                    </div>
                    <hr>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">LoginID</label>
                            <input name="loginID" type="text" class="form-control" placeholder="Loggin ID" pattern=".{5,20}" required title="5 to 12 characters">
                        </div>
                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="User First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label  class="col-form-label">Surname</label>
                            <input name="surname" type="text" class="form-control" placeholder="User Surname" value="" -pattern=".{5,12}" required -title="5 to 12 characters" >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">User Type</label>
                            <select class="form-control" name="userType" required>
                                <option value="">-- SELECT USER ROLE --</option>
                                <option value="admin">Admin</option>
                                <?php
                                $n = new DefaultView();
                                $n->userRolesLoop();
                                ?>
                            </select>
                        </div>
                    </div>
                    <span>Note: Password will be set when the user wants to login</span>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button name="btn_addUser" type="submit"  class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>


<!-- Bootstrap core JavaScript-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>

<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../assets/js/demo/chart-area-demo.js"></script>

<script src="../assets/js/demo/chart-pie-demo.js"></script>

<!-- Page level plugins -->
<script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>

<script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../assets/js/demo/datatables-demo.js"></script>

<!-- Date picker -->
<script src="../assets/js/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

</body>
</html>


