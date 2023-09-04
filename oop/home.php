<?php
include_once('./models/Students.php');

$students = Student::index();

if(isset($_POST['submit'])){
    $response = Student::create([
        'name' => $_POST['name'],
        'nis' => $_POST['nis'],
    ]);

    setcookie('message', $response, time() + 10);

    header("Location: home.php");
}
if(isset($_POST['delete'])){
    $response = Student::delete($_POST['id']);

    setcookie('message', $response, time() + 10);

    header("Location: home.php");
}

?>



<!-- top -->
<?php include('../bahan/top.php') ?>
    <!-- navigasi -->
    <?php include('../bahan/header.php') ?>

    <!-- content tersembunyi -->
    <div class="bg-slate-500 rounded-xl p-3 absolute top-1/2 -translate-y-12  left-1/2 -translate-x-1/2 hidden"></div>

    <!-- alert -->
    <?php include('../bahan/alert.php') ?>

    <!-- main -->
    <div class="flex">
        <!-- sidebar -->
        <div class="basis-1/4 bg-gray-500 h-96">
            <div class="bg-white m-5 p-3 rounded">
                <form action="" method="POST" class="m-5">
                    <h1 class="font-medium text-2xl mb-3">Form Data Siswa</h1>
                    <label for="name">Nama :</label>
                    <input type="text" name="name" id="name" placeholder="Masukkan nama"
                        class="block border border-gray-400 rounded w-full px-3 py-1 mb-3">
                    <label for="nis">NIS :</label>
                    <input type="number" name="nis" id="nis" placeholder="Masukkan nis"
                        class="block border border-gray-400 rounded w-full px-3 py-1 mb-3">
                    <button name="submit" class=" px-4 py-2 rounded-xl bg-blue-500 text-white hover:bg-blue-800">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        <!-- content -->
        <div class="basis-3/4 bg-cyan-500">
            <div class="bg-white m-6 p-5 rounded-xl">
                <h1 class="font-medium text-center text-2xl mb-3">Tabel data siswa</h1>
                <table class="text-center w-full">
                    <thead class="bg-gray-600 text-white">
                        <tr class="border">
                            <th class="p-2">No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-300">
                        <?php foreach ($students as $key => $student) : ?>
                        <tr class="border">
                            <td class="p-5"><?= $key + 1 ?></td>
                            <td><?= $student['name'] ?></td>
                            <td><?= $student['nis'] ?></td>
                            <td>
                            <a class="text-white hover:bg-blue-800 pt-2 pb-2 pr-3 pl-3 rounded-xl bg-blue-500" href="detail.php?id=<?= $student['id'] ?>" >Detail</a>
                            <a href="edit.php?id=<?= $student['id'] ?>" class="text-white hover:bg-blue-800 pt-2 pb-2 pr-3 pl-3 rounded-xl bg-blue-500">Edit</a>
                                <form action="" method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?= $student['id'] ?>">
                                    <button name="delete" type="submit" class="bg-red-500 hover:bg-red-800 p-2 rounded-xl text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include('../bahan/footer.php') ?>

<!-- bottom -->
<?php include('../bahan/bottom.php') ?>