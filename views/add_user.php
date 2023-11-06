<?php
require('../middleware/protected_page.php');

// Check user's role before allowing access
if ($_SESSION["user_role"] !== 'admin') {
    // User does not have an admin role, redirect or show an error
    header("Location: unauthorized.php"); // You can create an unauthorized page
    exit();
}

require('../partials/header.php');
require('../partials/navbar.php');
require('../partials/footer.php');

print($header);
?>

<style>

    /* Additional styling for the form elements */
    .form-label {
        font-size: 14px;
    }

    .form-control {
        font-size: 14px;
    }

    .btn-primary {
        font-size: 16px;
    }

    /* Style the password validation message */
    #password-message {
        font-size: 12px;
        margin-top: 5px;
    }
    .my-class-to-b {
        margin-bottom: 50px;
    }

</style>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.getElementById("password");
        const passwordMessage = document.getElementById("password-message");

        passwordInput.addEventListener("input", function () {
            const password = passwordInput.value;
            const strongPasswordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;

            if (strongPasswordRegex.test(password)) {
                passwordMessage.textContent = "Password is valid";
                passwordMessage.style.color = "green";
            } else {
                passwordMessage.textContent = "Password should contain at least 8 characters, including uppercase, lowercase, and numbers.";
                passwordMessage.style.color = "red";
            }
        });
    });
    function validatePassword() {
        const passwordInput = document.getElementById("password");
        const passwordMessage = document.getElementById("password-message");

        const password = passwordInput.value;
        const strongPasswordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;

        if (strongPasswordRegex.test(password)) {
            passwordMessage.textContent = "Password is valid";
            passwordMessage.style.color = "green";
            return true;
        } else {
            passwordMessage.textContent = "Password should contain at least 8 characters, including uppercase, lowercase, and numbers.";
            passwordMessage.style.color = "red";
            return false;
        }
    }

    function handleSubmit() {
        if (validatePassword()) {
            document.getElementById("password-form").submit();
        }
    }
</script>

<body>
    <?php
    print($adminNav);
    ?>
    <div class="container mt-3 my-class-to-b">
        <div class="gap-2 mb-3 d-inline">
            <a href="manage_user.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to User List</a>
            <p class="text-center fs-4 fw-bold">Add New User</p>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <form method="post" action="process_add_user.php" id="password-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small id="password-message" class="form-text"></small>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="handleSubmit()">Add User</button>
                </form>
            </div>
        </div>
    </div>
    <?php print($commonFooter) ?>
</body>

</html>
