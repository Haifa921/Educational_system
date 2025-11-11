<!-- Footer opened -->

    <!-- Your footer --><br>
   
    <div class="main-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
            <span>Copyright © 2024 - <span id="current-year"></span> <a href="#">IUST</a>. Powered by <a href="#">IT-Departement</a> All rights reserved.</span>
        </div>
    </div>
    
    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
    <script>
        function disableButton(btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> جاري التحميل...';
            btn.form.submit();
        }
    </script>

{{-- <div class="main-footer ht-40">
    <div class="container-fluid pd-t-0-f ht-100p">
        <span>Copyright © 2024 - <span id="current-year"></span> <a href="#">IUST</a>. Powered by <a
                href="#">IT-Departement</a> All rights reserved.</span>
    </div>
</div>
<script>
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>
<script>
    function disableButton(btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> جاري التحميل...';
        btn.form.submit();
    }
</script> --}}
<!-- Footer closed -->
