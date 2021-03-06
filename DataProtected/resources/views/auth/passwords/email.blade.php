@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="footer, address, phone, icons" />
        <title>Login SPD Center</title>

        <!-- form -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
		    <link rel="stylesheet" href="../css/form-elements.css">
        <link rel="stylesheet" href="../css/style.css">
        <!-- footer -->
        <link rel="stylesheet" href="../css/footer-distributed-with-address-and-phones.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../ico/logobeacukai.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../ico/logobeacukai.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../ico/logobeacukai.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../ico/logobeacukai.png">
        <link rel="apple-touch-icon-precomposed" href="../ico/logobeacukai.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>SPD Center dan Layanan Perbendaharaan</h1>
                            <div class="description" style="width:100%">
                            	<p style="font-size:17px">
www.xxxx.com adalah portal bagi pegawai Direktorat Jenderal Bea dan Cukai untuk memperoleh informasi terkait pencairan SPD. Selain itu, juga terdapat layanan perbendaharaan antara lain informasi pengelolaan TUKIN dan Bendahara Pengeluaran.
                            	</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Reset Password</h3>
                            		<p>Sistem akan mengrimkan link untuk mengubah password anda</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-envelope"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
                              @if (session('status'))
                              <div class="alert alert-success">
                                  {{ session('status') }}
                              </div>
                              @endif
                          <form role="form" action="{{ url('/password/email') }}" method="post" class="login-form">
                            {!! csrf_field() !!}
			                    	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="text" name="email" placeholder="Email" class="form-username form-control" id="form-username" value="{{ old('email') }}">
                                  @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                              </div>

			                        <button type="submit" class="btn">Kirim Link</button>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer-distributed">
          <div class="footer-left">
            <div><img src="../img/logobeacukai.png" style="float: left; width:120px; height:100px; margin-right:20px" alt="" /></div>
                <h3> Bagian Keuangan </h3>
                  <h3>Sub-bagian Perbendaharaan</h3>
<br><br><br><br><br><br><br><br><br>
            <div class="footer-company-name" style="">Bebek &copy; 2016</div>
          </div>
          <div class="footer-center">
            <div>
              <i class="fa fa-map-marker"></i>
              <p><span>Kantor Pusat DJBC Gedung Papua Lantai 3</span>
              <span>Jalan Jendral A. Yani, 13230 Kotak Pos 225 Jakarta 13013 </span>
              Jakarta, Indonesia</p>
            </div>
            <br>
            <div>
              <i class="fa fa-phone"></i>
              <p>(021) 4890308 ext 305</p>
            </div>
            <div>
              <i class="fa fa-envelope"></i>
              <p>Faksimile (021) 4890949</p>
            </div>
          </div>

          <div class="footer-right">
            <p class="footer-company-about">
              <span>Tentang Perusahaan</span>

            Sub-bagian Perbendaharaan mempunyai tugas melakukan urusan perbendaharaan Direktorat Jenderal dan penerbitan surat perintah pembayaran kepada Kantor Pelayanan Perbendaharaan Negara.
            </p>
            <div class="footer-icons">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
              <a href="#"><i class="fa fa-github"></i></a>
            </div>
          </div>
        </footer>



    </body>

</html>


<!-- Javascript -->
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/jquery.backstretch.min.js"></script>
<script src="../js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="assets/js/placeholder.js"></script>
<![endif]-->

@endsection
