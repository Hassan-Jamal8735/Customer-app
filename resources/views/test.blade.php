
    <main>
        <form action="{{url('/')}}/register" method="post">
            <!-- <pre> -->
            @csrf
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h2 class="text-center">Login</h2>
                        <form>

                            <div class="container mt-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <h2 class="text-center">Register</h2>
                                        <form>
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input name="name" type="text" class="form-control" id="name"
                                                    placeholder="Enter your name">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email address</label>
                                                <input name="email" type="email" class="form-control" id="email"
                                                    placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input name="password" type="password" class="form-control" id="password"
                                                    placeholder="Password">
                                            </div>
                                           
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </form>
    </main>