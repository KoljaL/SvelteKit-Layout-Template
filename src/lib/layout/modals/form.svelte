<script>
  export let message = 'Hi';
</script>



	<fieldset>
		<legend>{message}</legend>
		<form>
			<ul>
				<li>
					<label for="field1" class="required">Full Name</label>
					<input type="text" name="field1" class="half" placeholder="First" />
					<input type="text" name="field2" class="half" placeholder="Last" />
				</li>
				<li>
					<label for="field1">Full Name</label>
					<input type="text" name="field1" class="third" placeholder="First" />
					<input type="text" name="field1" class="third" placeholder="First" />
					<input type="text" name="field1" class="third" placeholder="First" />
				</li>
				<li>
					<label for="field1">Full Name</label>
					<input type="text" name="field1" class="quater" placeholder="First" />
					<input type="text" name="field1" class="quater" placeholder="First" />
					<input type="text" name="field1" class="quater" placeholder="First" />
					<input type="text" name="field1" class="quater" placeholder="First" />
				</li>

				<li>
					<label for="" class="required">Checkboxes</label>
					<div class="quater inline" >
						<label for="coding">Coding</label>
						<input type="checkbox" id="coding" name="interest" value="coding" />
					</div>
					<div class="quater inline" >
						<label for="music">Music</label>
						<input type="checkbox" id="music" name="interest" value="music" />
					</div>
					<div class="quater inline" >
						<label for="art">Art</label>
						<input type="checkbox" id="art" name="interest" value="art" />
					</div>
					<div class="quater inline" >
						<label for="sports">Sports</label>
						<input type="checkbox" id="sports" name="interest" value="sports" />
					</div>
				</li>

				<li>
					<label for="field3" class="required">Email</label>
					<input type="email" name="field3" class="full" />
				</li>
				<li>
					<label for="field4">Subject</label>
					<select name="field4" class="full">
						<option value="Advertise">Advertise</option>
						<option value="Partnership">Partnership</option>
						<option value="General Question">General</option>
					</select>
				</li>
				<li>
					<label for="field5">Your Message <span class="required">*</span></label>
					<textarea name="field5" id="field5" />
				</li>
				<li>
					<input type="submit" value="Submit" />
					<input type="submit" value="Cancel" class=cancel />
				</li>
			</ul>
		</form>
	</fieldset>