<div id="system-info">
	<table>
		<tr>
			<td class="desc"><?php _e( "WordPress Version", "wptouch-pro" ); ?></td>
			<td><?php echo sprintf( __( "%s", "wptouch-pro" ), get_bloginfo( 'version' ) ); ?></td>
		</tr>			
		<tr>
			<td class="desc"><?php _e( "Server Configuration", "wptouch-pro" ); ?></td>
			<td><?php echo $_SERVER['SERVER_SOFTWARE']; ?>, <?php echo $_SERVER['GATEWAY_INTERFACE']; ?>, PHP <?php echo phpversion(); ?>, <?php $link = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ); if ( !$link ) { die( 'Could not connect: ' . mysql_error() ); } printf( "MySQL %s", mysql_get_server_info() ) ;?></td>
		</tr>
		<tr>
			<td class="desc"><?php _e( "Browser User Agent", "wptouch-pro" ); ?></td>
			<td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td>
		<tr/>
	</table>
</div>