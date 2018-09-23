<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">{{ trans('adminlte_lang::message.recentactivity') }}</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">{{ trans('adminlte_lang::message.birthday') }}</h4>
                            <p>{{ trans('adminlte_lang::message.birthdaydate') }}</p>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">{{ trans('adminlte_lang::message.progress') }}</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::;'>
                        <h4 class="control-sidebar-subheading">
                            {{ trans('adminlte_lang::message.customtemplate') }}
                            <span class="label label-danger pull-right">70%</span>
                        </h4>
                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul><!-- /.control-sidebar-menu -->

        </div><!-- /.tab-pane -->
        <!-- Stats tab content -->

        <div class="tab-pane" id="control-sidebar-stats-tab">{{ trans('adminlte_lang::message.statstab') }}</div>

        
        <!-- Settings tab content -->
        <div class="tab-pane active" id="control-sidebar-settings-tab">
            <form method="post">
              <!-- <h3 class="control-sidebar-heading">{{ trans('adminlte_lang::message.generalset') }}</h3>-->
              <h3 class="control-sidebar-heading">Calculadora</h3>
                <div class="form-group">

                <form>
<table border="5" align=center>
<tr align="center">
<td colspan = 4>

<table border="3">
<tr>
<td align=center><input name="display" value="0" size=20></td>
</tr>
</table>

</td>
</tr>

<tr align=center>
<td>
<input type="button" value="    7    "
  onClick="addChar(this.form.display, '7')">
</td>
<td>
<input type="button" value="    8    "
  onClick="addChar(this.form.display, '8')">
</td>
<td>
<input type="button" value="    9    "
  onClick="addChar(this.form.display, '9')">
</td>
<td>
<input type="button" value="    /     "
  onClick="addChar(this.form.display, '/')">
</td>
</tr>

<tr align=center>
<td>
<input type="button" value="    4    "
  onClick="addChar(this.form.display, '4')">
</td>
<td>
<input type="button" value="    5    "
  onClick="addChar(this.form.display, '5')">
</td>
<td>
<input type="button" value="    6    "
  onClick="addChar(this.form.display, '6')">
</td>
<td>
<input type="button" value="    *    "
  onClick="addChar(this.form.display, '*')">
</td>
</tr>

<tr align=center>
<td>
<input type="button" value="    1    "
  onClick="addChar(this.form.display, '1')">
</td>
<td>
<input type="button" value="    2    "
  onClick="addChar(this.form.display, '2')">
</td>
<td>
<input type="button" value="    3    "
  onClick="addChar(this.form.display, '3')">
</td>
<td>
<input type="button" value="     -    " 
  onClick="addChar(this.form.display, '-')">
</td>
</tr>

<tr align=center>
<td>
<input type="button" value="    0    "
  onClick="addChar(this.form.display, '0')"> 
</td>
<td>
<input type="button" value="     .    "
  onClick="addChar(this.form.display, '.')"> 
</td>
<td>
<input type="button" value="   +/-   "
  onClick="changeSign(this.form.display)">
</td>
<td>
<input type="button" value="    +    "
  onClick="addChar(this.form.display, '+')">
</td>
</tr>

<tr align=center>
<td>
<input type="button" value="    (    "
  onClick="addChar(this.form.display, '(')"> 
</td>
<td>
<input type="button" value="     )    "
  onClick="addChar(this.form.display, ')')"> 
</td>
<td>
<input type="button" value="   sq    "
  onClick="if (checkNum(this.form.display.value))
	{ square(this.form) }">
</td>
<td>
<input type="button" value="    <-   "
  onClick="deleteChar(this.form.display)">
</td>
</tr>

<tr align=center>
<td colspan="2">
<input type="button" value="      =      " name="enter"
  onClick="if (checkNum(this.form.display.value))
	{ compute(this.form) }">
</td>
<td colspan="2">
<input type="button" value="         C          "
  onClick="this.form.display.value = 0 ">
</td>
</tr>
</table>
</form>
                   <!-- <label class="control-sidebar-subheading">
                        {{ trans('adminlte_lang::message.reportpanel') }}
                        <input type="checkbox" class="pull-right" {{ trans('adminlte_lang::message.checked') }} />
                    </label>
                    <p>
                        {{ trans('adminlte_lang::message.informationsettings') }}
                    </p>
                    -->
                </div><!-- /.form-group -->
            </form>
        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar

<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>


-------------------


@push ('scripts')
<script language="LiveScript">


function addChar(input, character)
{
    if(input.value == null || input.value == "0")
        input.value = character
    else
        input.value += character
}

function deleteChar(input)
{
    input.value = input.value.substring(0, input.value.length - 1)
}

function changeSign(input)
{
    // could use input.value = 0 - input.value, but let's show off substring
    if(input.value.substring(0, 1) == "-")
	input.value = input.value.substring(1, input.value.length)
    else
	input.value = "-" + input.value
}

function compute(form) 
{
	form.display.value = eval(form.display.value)
}

function square(form) 
{
	form.display.value = eval(form.display.value) * eval(form.display.value)
}

function checkNum(str) 
{
	for (var i = 0; i < str.length; i++) {
		var ch = str.substring(i, i+1)
		if (ch < "0" || ch > "9") {
			if (ch != "/" && ch != "*" && ch != "+" && ch != "-" 
				&& ch != "(" && ch!= ")") {
				alert("invalid entry!")
				return false
			}
		}
	}
	return true
}

<!--  -->
</script>
@endpush