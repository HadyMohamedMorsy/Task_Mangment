<div class="mt-5"></div>
<div class="pt-5"></div>

<div class="container ">
    <form class="row g-3 needs-validation" novalidate>
        <div class="row">
            <div class="col-md-4 mx-auto mt-5">
                <label for="validationCustom01" class="form-label">USERNAME</label>
                <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto mt-3">
                <label for="validationCustom02" class="form-label">PASSWORD</label>
                <input type="password" class="form-control" id="validationCustom02" value="Otto" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
        </div>

        <div class="row text-center">
                <button type="button" class="btn btn-primary mt-5 mx-auto col-2" data-bs-toggle="modal" data-bs-target="#exampleModal"> SUBMIT </button>
            </div>
            <div class="row text-center">
                <a href="../" class="link-secondary mx-auto col-2 mt-3">Login Page</a>
            </div>
    </form>
</div>

<script>

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
        })
    })()

</script>