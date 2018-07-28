<header class="hero">
  <?php
  if ( function_exists('yoast_breadcrumb') )
    yoast_breadcrumb('<p class="breadcrumbs">','</p>');

  $title = get_the_title();
  $title_alt = get_field('title_alt');

  if ( $title_alt )
    $title = $title_alt;

  if ( is_post_type_archive('portfolio') ) :
    echo '<h1 class="entry-title">Portfolio</h1>';

  elseif ( is_home() ) :
    echo '<h1 class="entry-title">Thoughts</h1>';

  elseif ( is_archive() ) :
    the_archive_title('<h1 class="entry-title">','</h1>');

  elseif ( is_search() ) :
    echo '<h1 class="entry-title"><em>Search:</em> ' . get_search_query() . '</h1>';

  else :
    echo '<h1 class="entry-title">' . $title . '</h1>';
    
  endif;
  ?>
</header>
