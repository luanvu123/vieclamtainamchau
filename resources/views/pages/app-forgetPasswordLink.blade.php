 @extends('layouts.layout_candidate')
 @section('content')
     <div class="auth-container">
         <div class="container">
             <div class="auth-card">
                 <div class="auth-header">
                     <h2>Quên mật khẩu</h2>
                     <p class="text-muted">Cùng xây dựng một hồ sơ nổi bật và nhận được các cơ hội sự
                         nghiệp lý tưởng</p>
                 </div>
                 <form action="{{ route('employer.reset.password.post') }}" method="POST">
                     @csrf
                     <input type="hidden" name="token" value="{{ $token }}">

                     <div class="form-floating">
                         <input type="email" class="form-control" id="email" name="email"
                             value="{{ $email }}" readonly>
                         <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                     </div>

                     <div class="form-floating">
                         <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                             required>
                         <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                     </div>

                     <div class="form-floating">
                         <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                             placeholder="Confirm Password" required>
                         <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                     </div>

                     <div class="form-floating">
                         <button type="submit" class="btn btn-primary">
                             Reset Password
                         </button>
                     </div>
                 </form>

             </div>
         </div>
     </div>
 @endsection
