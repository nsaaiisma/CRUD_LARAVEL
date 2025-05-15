<h2>Register Customer</h2>
<form method="POST" action="{{ route('customer.register') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="address" placeholder="Alamat">
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <button type="submit">Register</button>
</form>
