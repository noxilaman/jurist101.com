<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Jurist101 ค้นหากฎหมาย ค้นหาฎีกา ค้นหารัฐธรรมนูญ" />
    <meta name="keyword" content="ค้นหากฎหมาย, ค้นหาฎีกา, ค้นหารัฐธรรมนูญ,รัฐธรรมนูญ,กฎหมาย,ฎีกา" />
    <meta name="author" content="Jurist101" />
    <title>{{ config('app.name') }} ค้นหากฎหมายง่ายๆ </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
        rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('/mainpage/css/styles.css') }}" rel="stylesheet" />
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RCZ4QV6HTD"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RCZ4QV6HTD');
</script>
</head>

<body id="`">
    <!-- Navigation-->
    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"><a href="#page-top">{{ config('app.name') }}</a></li>
            <li class="sidebar-nav-item"><a href="#page-top">Home</a></li>
            
            {{-- <li class="sidebar-nav-item"><a href="#about">About</a></li> --}}
            <li class="sidebar-nav-item"><a href="#services">How to use</a></li>
            {{-- <li class="sidebar-nav-item"><a href="#portfolio">Portfolio</a></li> --}}


            @if (Route::has('login'))
                @auth
                    <li class="sidebar-nav-item"><a href="{{ url('/home') }}" title="ค้นหากฎหมาย หน้าหลัก">หน้าหลัก</a></li>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-700 dark:text-gray-500 underline" title="ค้นหากฎหมาย เข้าสู่ระบบ">เข้าสู่ระบบ</a>
                    <li class="sidebar-nav-item"><a href="{{ route('login') }}" title="ค้นหากฎหมาย เข้าสู่ระบบ">เข้าสู่ระบบ</a></li>
                    @if (Route::has('register'))
                        <li class="sidebar-nav-item"><a href="{{ route('register') }}" title="ค้นหากฎหมาย ลงทะเบียน">ลงทะเบียน</a></li>
                    @endif
                @endauth
            @endif


        </ul>
    </nav>

    <!-- page-top-->
    <section class="content-section" id="page-top">
        
        <div class="container text-center">
            <div class="mb-2">
                <img src="{{ asset('mainpage/assets/img/logo-juristq101.jpg') }}" alt="ค้นหากฎหมาย Jurist101" width="400px">
                <h1>ค้นหากฎหมาย Jurist101</h1>
            </div>
            <form action="{{ route('nonmember_searchact') }}" method="GET">


                <div class="input-group w-100">
                    @csrf
                    <input type="text" id="searchTxt" class="form-control form-control-lg" name="searchTxt"
                        placeholder="พิมพ์คำค้นหาที่นี่" minlength="3" required>

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-primary" title="ค้นหา" onclick="submitForm('')">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <br/>
 <a href="{{ url('/nonmember/search') }}" class="btn btn-primary" style="width:240px" title="ค้นหากฎหมาย Jurist101">ทดลองใช้งาน</a><br/>
<br/>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary" style="width:240px">เข้าใช้งาน</a>
                @else
                
                    <!-- ปุ่ม login Modal -->
                    <button type="button" class="btn btn-primary rounded-pill" style="width: 245px;" data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        เข้าสู่ระบบ
                    </button>

                    <!-- Login Modal -->
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginModalLabel">เข้าสู่ระบบ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3 text-start">
                                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 text-start">
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 form-check text-start">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                        </div>

                                        <div class="mb-3 text-start">
                                            <a class="btn btn-link p-0"
                                                href="{{ route('register') }}" title="ค้นหากฎหมาย ลงทะเบียน">{{ __('ลงทะเบียน') }}</a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">ปิด</button>
                                        <button type="submit" class="btn btn-primary ">{{ __('เข้าสู่ระบบ') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if (Route::has('register'))
                        {{-- <a href="{{ route('register') }}" class="btn btn-primary" style="width:245px">สมัครสมาชิก</a> --}}
                        <!-- ปุ่มเปิด Modal สมัครสมาชิก -->
                        <button type="button" class="btn btn-primary rounded-pill" style="width: 245px;"
                            data-bs-toggle="modal" data-bs-target="#registerModal">
                            สมัครสมาชิก
                        </button>

                        <!-- Modal สมัครสมาชิก -->
                        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="registerModalLabel">สมัครสมาชิก</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3 text-start">
                                                <label for="name" class="form-label">{{ __('ชื่อ-สกุล') }}</label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" value="{{ old('name') }}" required
                                                    autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3 text-start">
                                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                                <input id="username" type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    name="username" value="{{ old('username') }}" required
                                                    autocomplete="username">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3 text-start">
                                                <label for="email"
                                                    class="form-label">{{ __('Email Address') }}</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3 text-start">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3 text-start">
                                                <label for="password-confirm"
                                                    class="form-label">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">ปิด</button>
                                            <button type="submit" class="btn btn-primary">{{ __('ลงทะเบียน') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
            @endif
        </div>`
    </section>
    <!-- Services-->
    <section class="content-section bg-primary text-white text-center" id="services">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading">
                <h3 class="text-secondary mb-0"></h3>
                <h2 class="mb-5">วิธีการใช้งาน</h2>
            </div>
            <div class="row gx-4 gx-lg-5 align-items-center text-center">
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <span class="service-icon rounded-circle mx-auto mb-3"><i
                            class="fa-solid fa-user fa-2xl"></i></span>
                    <h4><strong>สมัครสมาชิก</strong></h4>
                    <p class="text-faded mb-0">สมัครสมาชิก เพื่อใช้งาน</p>
                </div>

                <div class="col-lg-1 col-md-6 mb-5 mb-lg-0 d-flex justify-content-center">
                    <i class="fa-solid fa-arrow-right fa-2xl"></i>
                </div>

                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <span class="service-icon rounded-circle mx-auto mb-3"><i
                            class="fa-solid fa-magnifying-glass fa-2xl"></i></span>
                    <h4><strong>ค้นหา</strong></h4>
                    <p class="text-faded mb-0">ค้นหาคำที่เกี่ยวข้องต่าง ๆ</p>
                </div>

                <div class="col-lg-1 col-md-6 mb-5 mb-lg-0 d-flex justify-content-center">
                    <i class="fa-solid fa-arrow-right fa-2xl"></i>
                </div>

                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                    <span class="service-icon rounded-circle mx-auto mb-3"><i
                            class="fa-solid fa-bookmark fa-2xl"></i></span>
                    <h4><strong>Bookmark</strong></h4>
                    <p class="text-faded mb-0">เก็บไว้เพื่อการเข้าถึงในภายหลัง</p>
                </div>
            </div>

        </div>
    </section>
    <!-- Callout-->
   
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container px-4 px-lg-5">

            <div class="text-start mb-2">
                <h2>About Us</h2>
                <p><a href="https://jurist101.com/" title="ค้นหากฎหมาย jurist101"><strong>Jurist 101 </strong></a> เป็นเว็บไซต์ที่เกี่ยวกับกฎหมาย
                    โดยมุ่งเน้นให้ผู้ใช้งานสามารถค้นหาข้อมูลทางกฎหมายได้อย่างง่ายดายและรวดเร็ว
                    ด้วยการอัพเดตข้อมูลที่ทันสมัยที่สุด
                    เพื่อให้ผู้ใช้เข้าถึงกฎหมายและข้อมูลที่เกี่ยวข้องได้อย่างครบถ้วนและเชื่อถือได้ ทั้งนี้
                    เว็บไซต์ยังออกแบบมาให้ใช้งานง่ายและสะดวกสบายสำหรับทุกคนที่ต้องการข้อมูลทางกฎหมายในชีวิตประจำวัน</p>
            </div>

            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="https://www.facebook.com/jurist101" title="ค้นหากฎหมาย jurist101"><i
                            class="icon-social-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!" title="ค้นหากฎหมาย jurist101"><i
                            class="icon-social-twitter"></i></a>
                </li>
            </ul>
            <p class="text-muted small mb-0">Copyright &copy; jurist101 2023</p>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('/mainpage/js/scripts.js') }}"></script>
</body>

</html>
