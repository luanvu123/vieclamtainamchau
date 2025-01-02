 @extends('layouts.layout_candidate')
 @section('content')
     <div class="auth-container">
         <div class="container">
             <div class="auth-card">
                 <div class="auth-header">
                     <h2>Quên mật khẩu</h2>
                     <p class="text-muted">Chào mừng bạn trở lại!</p>
                 </div>

                 <form action="{{ route('candidate.forget.password.post') }}" method="POST">
                     @csrf
                     <div class="form-floating">
                         <input type="email" class="form-control" id="email" name="email"
                             placeholder="name@example.com" required>
                         <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                     </div>
                     <div class="form-floating">
                         <button type="submit" class="btn btn-primary">
                             Send Password Reset Link
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 @endsection
