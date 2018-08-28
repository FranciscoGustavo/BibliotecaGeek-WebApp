<!--=====================================================
  MENU LATERAL
======================================================-->
<div class="menu-bars">
  <div class="user-bars">
    <img src="<?php printf($dashboard.$_SESSION['adminPhoto']); ?>" alt="">
    <p><?php printf($_SESSION['adminName']." ".$_SESSION['adminLastName']); ?></p>
    <p><?php printf($_SESSION['adminEmail']); ?></p>
  </div>
  <nav class="menu">
    <ul>
      <li>
        <a href="<?php printf($dashboard); ?>">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
      </li>

      <li>
        <a href="<?php printf($dashboard."articles"); ?>">
          <i class="fas fa-th"></i>
          <span>Articulos</span>
        </a>
      </li>

      <li>
        <a href="<?php printf($dashboard."comments"); ?>">
          <i class="fas fa-comments"></i>
          <span>Comentarios</span>
        </a>
      </li>

      <li>
        <a href="<?php printf($dashboard."categories"); ?>">
          <i class="fas fa-address-book"></i>
          <span>Categorias</span>
        </a>
      </li>

      <li>
        <a href="<?php printf($dashboard."users"); ?>">
          <i class="fas fa-users"></i>
          <span>Usuarios</span>
        </a>
      </li>

      <li>
        <a href="<?php printf($dashboard."perfiles"); ?>">
          <i class="fas fa-users-cog"></i>
          <span>Perfiles</span>
        </a>
      </li>

    </ul>
  </nav>
</div>
