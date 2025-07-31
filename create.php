<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
  .input-custom {
    border-radius: 12px;
    padding: 12px;
    border: 1px solid #ccc;
    width: 100%;
    font-size: 14px;
    margin-bottom: 12px;
  }

  .btn-submit {
    background-color: #004aad;
    color: white;
    padding: 10px;
    font-weight: bold;
    border-radius: 12px;
    width: 100%;
    border: none;
  }
</style>

<div class="px-3">
  <h5 class="fw-bold text-center my-3">Buat Transaksi</h5>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
      <?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>

  <form action="<?= site_url('transaction/store') ?>" method="POST">
    <?= csrf_field() ?>

    <!-- Jenis Transaksi -->
    <div class="d-flex mb-3">
      <label class="me-3">
        <input type="radio" name="jenis" value="pemasukan" checked> Pemasukan
      </label>
      <label>
        <input type="radio" name="jenis" value="pengeluaran"> Pengeluaran
      </label>
    </div>

    <!-- Nominal -->
    <input type="number" name="nominal" class="input-custom" placeholder="Rp.0" required>

    <!-- Kategori -->
    <label class="fw-semibold mb-1">Kategori</label>
    <select name="kategori" class="input-custom" required>
      <option disabled selected>Pilih Kategori</option>
      <?php
        $kategoriList = [
          'Gaji', 'Transfer', 'Tiket', 'Belanja', 'Kesehatan',
          'Kendaraan', 'Makanan', 'Elektronik', 'Olahraga',
          'Properti', 'Pendidikan', 'Game'
        ];
        foreach ($kategoriList as $k) {
          echo "<option value=\"$k\">$k</option>";
        }
      ?>
    </select>

    <!-- Catatan -->
    <input type="text" name="catatan" class="input-custom" placeholder="Catat sesuatu (opsional)">

    <!-- Tanggal -->
    <input type="date" name="tanggal" class="input-custom" value="<?= date('Y-m-d') ?>" required>

    <!-- Wallet -->
    <select name="wallet_id" class="input-custom" required>
  <?php foreach ($wallets as $wallet): ?>
    <option value="<?= esc($wallet['id']) ?>"><?= esc($wallet['name']) ?></option>

  <?php endforeach; ?>
</select>




    <button type="submit" class="btn-submit">Simpan</button>
  </form>
</div>

<?= $this->endSection() ?>
