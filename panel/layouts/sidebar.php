<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
          href="<?= url('panel') ?>"
          class="list-group-item list-group-item-action py-2 ripple"
          aria-current="true">
          <i class="fa-solid fa-gauge-high me-3"></i><span>Панель</span>
        </a>
        <a href="<?= url('panel/category') ?>" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fa-solid fa-tags me-3"></i><span>Категории</span>
        </a>
        <a href="<?= url('panel/post') ?>" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fa-solid fa-table-list me-3"></i><span>Посты</span></a>
      </div>
    </div>
  </nav>
<!--section class="sidebar">
    <section class="sidebar-link">
        <a href="<?= url('panel') ?>">Панель</a>
    </section>
    <section class="sidebar-link">
        <a href="<?= url('panel/category') ?>">Категории</a>
    </section>
    <section class="sidebar-link">
        <a href="<?= url('panel/post') ?>">Посты</a>
    </section>
</section-->

