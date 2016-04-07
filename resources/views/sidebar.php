<!-- 4. $MAIN_MENU =================================================================================

    Main menu
    
    Notes:
    * to make the menu item active, add a class 'active' to the <li>
      example: <li class="active">...</li>
    * multilevel submenu example:
      <li class="mm-dropdown">
        <a href="#"><span class="mm-text">Submenu item text 1</span></a>
        <ul>
        <li>...</li>
        <li class="mm-dropdown">
          <a href="#"><span class="mm-text">Submenu item text 2</span></a>
          <ul>
          <li>...</li>
          ...
          </ul>
        </li>
        ...
        </ul>
      </li>
-->
  <div id="main-menu" role="navigation">
    <div id="main-menu-inner">
      
      <ul class="navigation">
        <li class="mm-dropdown">
          <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Produtos</span></a>
          <ul>
            <li>
              <a tabindex="-1" href="/product"><span class="mm-text">Lista</span></a>
            </li>
            <li>
              <a tabindex="-1" href="/product/create"><span class="mm-text">+ Produto</span></a>
            </li>
          </ul>
        </li>
        <li class="mm">
          <a href="/question"><i class="menu-icon fa fa-question"></i><span class="mm-text">Perguntas</span></a>
        </li>
        <li class="mm">
          <a  href="/order"><i class="menu-icon fa fa-shopping-cart"></i><span class="mm-text">Vendas</span></a>
        </li>        
      </ul> <!-- / .navigation -->
    </div> <!-- / #main-menu-inner -->
  </div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->