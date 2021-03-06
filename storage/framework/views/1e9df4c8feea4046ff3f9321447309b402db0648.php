<li><a href="<?php echo e(route('ktu.dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard KTU</span></a>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas Akademik</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo e(route('ktu.sutgas-pembimbing.index')); ?>">Pembimbing Skripsi</a></li>
        <li><a href="<?php echo e(route('ktu.sutgas-pembahas.index')); ?>">Pembahas Sempro</a></li>
        <li><a href="<?php echo e(route('ktu.sutgas-penguji.index')); ?>">penguji Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>SK Akademik</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo e(route('ktu.sk-sempro.index')); ?>">SK Sempro</a></li>
        <li><a href="<?php echo e(route('ktu.sk-skripsi.index')); ?>">SK Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Honor SK</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="<?php echo e(route('ktu.honor-sempro.index')); ?>">Honor SK Sempro</a></li>
        <li><a href="<?php echo e(route('ktu.honor-skripsi.index')); ?>">Honor SK Skripsi</a></li>
    </ul>
</li>

<li>
    <a href="<?php echo e(route('ktu.memu.index')); ?>">
        <i class="fa fa-link"></i> <span>Lihat Memo</span>
        <span class="pull-right-container">
            <small class="label pull-right bg-green" id="jumlah_memo"></small>
        </span>
    </a>
</li>



<li>
    <a href="<?php echo e(route('ktu.surat.index')); ?>"><i class="fa fa-link"></i> <span>Surat Tugas Kepegawaian</span></a>
</li>



<li>
    <a href="<?php echo e(route('ktu.peminjaman_barang.index')); ?>"><i class="fa fa-link"></i> <span>Peminjaman Barang</span></a>
</li>

<li>
    <a href="<?php echo e(route('ktu.peminjaman_ruang.index')); ?>"><i class="fa fa-link"></i> <span>Peminjaman Ruang</span></a>
</li>
<?php /**PATH C:\xampp\htdocs\siteri\resources\views/include/ktu_menu.blade.php ENDPATH**/ ?>