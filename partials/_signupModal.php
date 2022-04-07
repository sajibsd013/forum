<div class="modal fade" id="signupmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="signupmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupmodalLabel">Signup for an iDiscuss account </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/forum/partials/_handleSignup.php" method='post'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name </label>
                        <input type="text" minlength="5" class="form-control my-1" id="signupName" name="signupName"  required>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" minlength="8" class="form-control my-1" id="signupEmail" name="signupEmail" aria-describedby="emailHelp" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date of Birth</label>
                        <input type="date" class="form-control my-1" id="signupBirthday" name="signupBirthday" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" minlength="8" class="form-control my-1" id="password1" name="signupPassword1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" minlength="8" class="form-control my-1" id="password2" name="signupPassword2" required>
                    </div>
                    <button type="submit" class="btn btn-primary my-2">Signup</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>