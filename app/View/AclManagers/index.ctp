<h1 class="grid_12">Aclhanteraren</h1>
<div class="grid_6">
	<h3>Varning!</h3>
	<p>Är du osäker på vad du gör, gör det inte!</p>
	
	<p>Att skriva om Aco's kan vara en relativt tung
	åtgärd för databasen. Finns det många medlemmar och mycket speciella privilegier kan detta ta 
	flera sekunder. Databasens tabeller är exklusivt låsta under hela operationen, därför kommer 
	sidans användare inte att kunna ladda sidan medan åtgärden utförs. Utför därför inte åtgärden i 
	onödan.</p>
	
	<h3>Acl</h3>
	<p>Acl betyder Access Control List och är det system denna sajt använder för att hantera 
	rättigheter för användare och grupper. För att förstå detta system, läs vidare i denna
	kolumn. Du måste förstå vad Aco och Aro är innan du använder funktionerna.</p>

	<h3>Aro</h3>
	<p>Aro betyder Access Request Object. Det är precis som namnet antyder ett objekt som efterfrågar
	rättigheter. I vårt fall är användare och grupper två stycken Aro's. Alla Aro sparas i databasen
	i tabellen <em>aros</em>. Denna tabell sköter sig själv! När en användare skapas läggs automatiskt
	en rad till i tabellen och när en användare tas bort tas även dess Aro bort.</p>

	<h3>Aco</h3>
	<p>Aco betyder Access Control Object. Det är sådana objekt Aro's frågar efter access. I vårt fall är
	exempel på Aco's controllers och dess actions. Det vill säga att controllern UsersController är en
	Aco och även UsersController::index(), UsersController::login() osv. också är Aco's. Alla Aco's
	sparas i databasen i tabellen acos. Denna tabell måste uppdateras när en controller eller ett action
	läggs till eller tas bort. Om inte detta görs när en ny controller läggs till går det inte att nå
	controllern. Om detta inte görs när en controller tas bort kommer det fortfarande gå att nå adressen
	till controllern och ett "Missing controller" felmeddelande kommer visas.</p>

	<h3>Privilegier</h3>
	<p>För att ge Aro's tillgång till Aco's måste man skapa ytterligare en lista som innehåller privilegier.
	Denna finns i databasen i tabellen aros_acos. Tabellen innehåller relationer mellan Aro's och Aco's och 
	anger vilka rättighet som finns mellan dessa. Observera att om en rättighet ges till en controller så ger
	detta rättighet till alla controllerns actions som standard. Detta kan motverkas genom att ge negativt
	privilegie till de action som Aro't inte ska ha rättighet till.</p>
</div>

<div class="grid_6">
	<h3>Åtgärder</h3>
<?php echo $this->Form->Create('AclManager', array('action' => 'rewrite_acos')); ?>
	<?php 
		echo $this->Form->input('rewrite', array('type' => 'hidden', 'value' => 'rewrite')); 
		echo $this->Form->submit('Skriv om acos'); 
	?>
<?php echo $this->Form->End(); ?>
</div>
