<li><a href="{{ route('dekan.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard Dekan</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>SK Akademik</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('dekan.sk-sempro.index') }}">SK Sempro</a></li>
      <li><a href="{{ route('dekan.sk-skripsi.index') }}">SK Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Honor SK</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('dekan.honor-sempro.index') }}">Honor SK Sempro</a></li>
      <li><a href="{{ route('dekan.honor-skripsi.index') }}">Honor SK Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Skripsi Mahasiswa</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('dekan.pembimbing-skripsi') }}">Pembimbing Skripsi</a></li>
      <li><a href="{{ route('dekan.pembahas-sempro') }}">Pembahas Sempro</a></li>
      <li><a href="{{ route('dekan.penguji-skripsi') }}">Penguji Skripsi</a></li>
    </ul>
</li>
<li class="treeview">
  <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('dekan.surat.index') }}">Lihat Surat Tugas</a></li>
    <li><a href="{{ route('dekan.dosen_upload_index') }}">Upload bukti</a></li>
  </ul>
</li>
