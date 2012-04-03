$my_array = array( 'one', 'two', 'three' );
$iterator = new WPtouchArrayIterator( $my_array );

while ( $iterator->have_items() ) {
	echo $iterator->have_items();
}
