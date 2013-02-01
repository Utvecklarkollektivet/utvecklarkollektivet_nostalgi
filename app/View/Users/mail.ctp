<h1>Skriv nytt mail</h1><br />
<?php echo $this->Form->create('User', array('type' => 'post')); ?>
<h4>Markera de användare du vill maila..</h4>
<div class="row">
	<div class="span10">
		<table class="table">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('username', 'Användarnamn'); ?></th>
						<th><?php echo $this->Paginator->sort('group_id', 'Grupp'); ?></th>
						<th><?php echo $this->Paginator->sort('created', 'Skapad'); ?></th>
						<th><span class="markAll" title="Klicka för att markera alla användare">Markera</span></th>
					</tr>
			</thead>
			<tbody>
			<?php
			foreach ($users as $user): ?>
				<tr>
					<td>
						<?php echo $this->Html->link($user['User']['username'], array('action' => 'view', $user['User']['id'])); ?>
					</td>
					<td>
						<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
					</td>
					<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
					<td><?php echo $this->Form->input('selected.', array('type' => 'checkbox', 'value' => $user['User']['username'], 'hiddenField' => false, 'class' => 'mail_checkbox', 'onchange' => 'check_val()')); ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
			<script type="text/javascript">
			//Tack till Filip för javascript-koden

                                        $(".mail_checkbox").on("click", function () {
                $(".markAll").data("status", true).prop("checked", false);
                peopleCollection();
            });

            $(".markAll").on("click", function () {
                var status = $(this).data("status");

                $(".mail_checkbox").each(function () {
                    $(this).prop("checked", status);
                });

                peopleCollection();
                $(this).data("status", !status);
            });

            function peopleCollection() {

                var pplarray = new Array();
                var ppl = "";
                var count = 0;

                $(".mail_checkbox").each(function () {
                    if (this.checked) {
                        count++;
                        pplarray.push($(this).val());
                    }
                });
                $(".count").empty().append(count);

                var index = 0;
                $.each(pplarray, function () {
                    if (index === 0) {
                        ppl += this;
                    } else if (index === pplarray.length - 1) {
                        ppl += " och " + this + ".";
                    } else {                        
                        ppl += ", " + this;
                    }
                    index++;
                });
                $(".ppl").empty().append(ppl);
            }
        
		</script>
		<h4>..eller välj en grupp</h4> 
		<?php echo $this->Form->input(
					'group_id', 
					array(
						'label' => false,
						'error' => false,
						'options' => $groups, 
						'empty' => 'Välj en grupp...'
					)
				); ?>
	</div>
</div>
<div class="span6">
	<h4><b>Skickas till:</b></h4><p class="ppl"></p>
	<?php echo $this->Form->input(
						'head',
						array(
							'label' => false,
							'div' => false,
							'class' => 'mail_head',
							'placeholder' => 'Överskrift..',
							'error' => false,
							'id' => 'prependedInput'
						)
					);; ?>
	<?php echo $this->Form->input('Text', array('rows' => '8', 'class' => 'text-area-fix')); ?>
	<?php echo $this->Form->end('Skicka', array('type' => 'submit', 'class' => 'btn')); ?>
</div>