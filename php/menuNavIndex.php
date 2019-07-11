ç<?php
// Menu principal para la pagina principal index.php
echo "<ul id='lista_principal_index'>
        <li id='inicio'><a href='inicio' title='Inicio'><img src='img/logos/TheFantasticL.png' alt='The Fantastic L'/></a></li>
        <li id='sobreNosotros'><a href='sobre-nosotros/' title='Sobre nosotros'>Sobre nosotros</a></li>
        <li id='consultoria' class='desplegable'><a href='' title='Consultoría'>Consultoría</a>
            <ul id='menu_consultoria'>
                    <li id='enEmpresa'><a href='consultoria/' title='En Empresa'>En Empresa</a></li>
                    <li id='workshops'><a href='consultoria/' title='Workshops'>Workshops</a></li>
                    <li id='adHoc'><a href='consultoria/' title='Ad Hoc'>Ad Hoc</a></li>
            </ul>
        </li>
        <li id='campaign'><a href='campaign-management/' title='Campaign Management'>Campaign Management</a></li>
        <li id='contacto'><a href='contacto/' title='Contacto'>Contacto</a></li>
        <li id='blog'><a href='blog/' title='Blog'>Blog</a></li>
    
        <li id='menu_moviles'><i class='fa fa-bars' aria-hidden='true'></i></a>
            <ul id='lista_movil'>
                <li id='sobreNosotros2'><a href='sobre-nosotros/' title='Sobre nosotros'>Sobre nosotros</a></li>
                <li id='consultoria2'><a href='consultoria/' title='Consultoría'>Consultoría</a>        
                    <ul id='menu_consultoria2'>
                        <li id='enEmpresa'><a href='consultoria/' title='En Empresa'>En Empresa</a></li>
                        <li id='workshops'><a href='consultoria/' title='Workshops'>Workshops</a></li>
                        <li id='adHoc'><a href='consultoria/' title='Ad Hoc'>Ad Hoc</a></li>
                    </ul>        
                </li>
                <li id='campaign2'><a href='campaign-management/' title='Campaign Management'>Campaign Management</a></li>
                <li id='contacto2'><a href='contacto/' title='Contacto'>Contacto</a></li>
                <li id='blog2'><a href='blog/' title='Blog'>Blog</a></li>
            </ul>
        </li>
        <li id='idioma'><img class='bandera espanola' src='img/banderas/Spain.png' alt='Español' title='Español'/><img class='bandera inglesa' src='img/banderas/United-Kingdom.png' alt='Inglés' title='Inglés'/></li>
    
      <ul>";