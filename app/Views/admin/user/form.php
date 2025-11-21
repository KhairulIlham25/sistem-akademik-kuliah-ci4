<form action="/admin/user/simpan" method="post">
  <label>Username</label>
  <input type="text" name="username" required>

  <label>Password</label>
  <input type="password" name="password" required>

  <label>Role</label>
  <select name="role">
    <option value="admin">Admin</option>
    <option value="mahasiswa">Mahasiswa</option>
    <option value="dosen">Dosen</option>
  </select>

  <label>Related ID</label>
  <input type="text" name="related_id" placeholder="NIM / NIDN">

  <button type="submit">Simpan</button>
</form>
