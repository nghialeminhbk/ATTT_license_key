<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>    
    <title>ATTT Project</title>
    <script>
        $(window).on('load', function(){
            $('#MyModal').modal('show');
        });
    </script>
</head>
<body class="container">
<?php
$secret_code = 'nghiatitan'; // ma bi mat xac dinh cho moi
$time_created = '2021-07-12 11:41:52'; // ngay tao dang ki
$username = 'username'; // username cua nguoi do
$password = 'password'; // password nguoi do da dang ki
$ip = '::1'; // ip nguoi dung da dang ki
function decrypt($ivHashCiphertext, $password) {
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);

    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;

    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}
 $license_hash_compare = sha1($username.$password.$time_created.$secret_code.$ip);

 $lisfile = sha1($username.$password).'.key';

// kiem tra file ton tai
 if(!file_exists(__DIR__.'/'.$lisfile))
 {
    header('Location: activator.html');
 }else{
    $data = file_get_contents(__DIR__.'/'.$lisfile);
    $license_hash = decrypt($data, $secret_code);
    if($license_hash != $license_hash_compare){
        header('Location: activator.html');
    }
 }
 ?>

<header class="px-3 pt-2 sticky-top bg-body d-flex justify-content-between flex-row border-bottom">
        <div class="logo">
            <i class="fas fa-user-shield text-dark"></i> <strong class="text-dark">NGHIATITAN</strong>
        </div>
        <div class="d-flex flex-row">
            <a class="text-decoration-none text-dark me-2">Hello admin</a>
            <a class="text-decoration-none text-dark " href="#"><strong>Logout</strong></a>
        </div>
   </header>
   <section class="workspace d-flex" >
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="bg-body px-3 py-2">
            <ol class="breadcrumb m-0 fw-bold">
            <li class="breadcrumb-item text"><a class="text-decoration-none text-dark" href="/admin">My workspace</a></li>
            <li class="breadcrumb-item active text-muted" aria-current="page">Summary</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center px-3 border-start border-2">
            <a href="" class="px-1 border-bottom border-dark border-2 text-decoration-none text-dark fw-bold">Result</a>
            <a href="" class="px-1 text-decoration-none text-muted">Create</a>
        </div>
   </section>
   <nav class="navbar navbar-expand-lg navbar-light bg-body border-top border-bottom border-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 border-bottom-4">
          <li class="nav-item">
            <a class="nav-link text-muted" aria-current="page" href="">Insight</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold" href="#">Summary</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="">Response [4]</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
    <section class="content mt-4 container-fluid mb-3">
        <div class="card bg-body border-success">
            <div class="card-header fw-bold text-dark bg-white">
                Response Summary
            </div>
            <div class="card-body">
                <div class="card mb-3 border border-1 border-dark">
                    <div class="card-header bg-body">
                        <div class="card-title fw-bold">Question 1:</div>
                        <small class="text-muted fw-bold">3 out of 4 people answered this question</small>
                    </div>
                    <div class="card-body">
                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">A</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-dark bg-gradient text-white" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <small class="response p-2 fw-bold text-muted">2 responses</small>
                        </div>

                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">B</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-dark bg-gradient text-white" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <small class="response p-2 fw-bold text-muted">2 responses</small>
                        </div>

                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">C</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-dark bg-gradient text-white" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <small class="response p-2 fw-bold text-muted">2 responses</small>
                        </div>

                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">D</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-dark bg-gradient text-white" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <small class="response p-2 fw-bold text-muted">2 responses</small>
                        </div>
                        
                    </div>
                </div>
                <div class="modal fade" id="MyModal" tabindex="-1" aria-labelledby="MyModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="MyModalLabel">Welcome notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body d-flex fs-5">
                        Welcome you to my application?
                      </div>
                      <div class="modal-footer">
                        <button href="#" class="btn btn-dark" data-bs-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="card mb-3">
                    <div class="card-header bg-body">
                        <div class="card-title fw-bold">Question 1:</div>
                        <small class="text-muted fw-bold">3 out of 4 people answered this question</small>
                    </div>
                    <div class="card-body">
                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">A</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-body text-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <div class="response p-2 fw-bold text-muted">2 responses</div>
                        </div>

                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">B</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-body text-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <div class="response p-2 fw-bold text-muted">2 responses</div>
                        </div>

                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">C</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-body text-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <div class="response p-2 fw-bold text-muted">2 responses</div>
                        </div>

                        <div class="group-bar d-flex flex-row align-items-center mb-3">
                            <div class="answer p-2 fw-bold">D</div>
                            <div class="progress" style="width:80%; height: 40px;" >
                                <div class="progress-bar bg-body text-dark" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <div class="response p-2 fw-bold text-muted">2 responses</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="container bg-body d-flex flex-row justify-content-between text-center">
      <div class="start-footer text-dark fs-2 d-flex align-items-center justify-content-space">
        <i class="fab fa-facebook-square me-2"></i>
        <i class="fab fa-instagram me-2"></i>
        <i class="fab fa-github me-2"></i>
      </div>
      <div class="text-dark fw-bold end-footer d-flex flex-column justify-content-center">
        <p class="m-0">Make by NGHIATITAN</p>
        <p class="m-0">&copy No copyright!</p>
      </div>
    </footer>
</body>
</html>