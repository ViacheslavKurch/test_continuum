<div class="row">
    <div class="col-md-6">
        <form method="POST" action="/login">
            <input type="hidden" name="_method" value="POST" />
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="">
            </div>
            <button type="submit" class="btn btn-dark btn-sm">Login</button>
        </form>
    </div>
</div>