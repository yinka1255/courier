	$.fbuilder.controls[ 'fnumber' ] = function(){};
	$.extend(
		$.fbuilder.controls[ 'fnumber' ].prototype,
		$.fbuilder.controls[ 'ffields' ].prototype,
		{
			title:"Number",
			ftype:"fnumber",
			predefined:"",
			predefinedClick:false,
			required:false,
			readonly:false,
			size:"small",
			thousandSeparator:"",
			decimalSymbol:".",
			min:"",
			max:"",
			formatDynamically:false,
			dformat:"digits",
			formats:new Array("digits","number"),
			getFormattedValue:function( value )
				{
					if(value == '') return value;
					var ts = this.thousandSeparator,
						ds = ((ds=$.trim(this.decimalSymbol)) !== '') ? ds : '.',
						v = $.fbuilder.parseVal(value, ts, ds),
						s = '',
						counter = 0,
						str = '',
						parts = [];

					if(!isNaN(v))
					{
						if(v < 0) s = '-';
						v = ABS(v);
						parts = v.toString().split(".");

						for(var i = parts[0].length-1; i >= 0; i--){
							counter++;
							str = parts[0][i] + str;
							if(counter%3 == 0 && i != 0) str = ts + str;

						}
						parts[0] = str;
						return s+parts.join(ds);
					}
					else
					{
						return value;
					}
				},
			show:function()
				{
					var _type = ( this.dformat == 'digits' || ( /^\s*$/.test( this.thousandSeparator ) &&  /^\s*\.\s*$/.test( this.decimalSymbol ) ) ) ? 'number' : 'text';

					return '<div class="fields '+this.csslayout+' '+this.name+' cff-number-field" id="field'+this.form_identifier+'-'+this.index+'"><label for="'+this.name+'">'+this.title+''+((this.required)?"<span class='r'>*</span>":"")+'</label><div class="dfield"><input id="'+this.name+'" name="'+this.name+'" '+( ( !/^\s*$/.test( this.min) ) ? 'min="'+$.fbuilder.parseVal( this.min, this.thousandSeparator, this.decimalSymbol )+'" ' : '' )+( ( !/^\s*$/.test( this.max) ) ? ' max="'+$.fbuilder.parseVal( this.max, this.thousandSeparator, this.decimalSymbol )+'" ' : '' )+' class="field '+this.dformat+' '+this.size+((this.required)?" required":"")+'" type="'+_type+'" value="'+$.fbuilder.htmlEncode((this.formatDynamically) ? this.getFormattedValue(this.predefined) : this.predefined)+'" '+((this.readonly)?'readonly':'')+' /><span class="uh">'+this.userhelp+'</span></div><div class="clearer"></div></div>';
				},
			after_show:function()
				{
					var me = this;
					if( this.formatDynamically && this.dformat != 'digits' )
					{
						$( document ).on( 'change', '[name="' + me.name + '"]', function(){
							this.value = me.getFormattedValue( this.value );
						} );
					}

					if( typeof $[ 'validator' ] != 'undefined' )
					{

						$.validator.methods.number = function(v, el)
							{
								var f = el.id.match(/_\d+$/),
									esc = $.fbuilder.escape_symbol,
									e, r;

								if(f) e = $.fbuilder['forms'][f[0]].getItem(el.name);
								if(!e) e = {thousandSeparator: ',', decimalSymbol: '.'};

								r = new RegExp('^\\s*\\-?\\d+('+esc(e.thousandSeparator)+'\\d{3})*('+esc(e.decimalSymbol)+'\\d+)?\\s*$','i');

								return this.optional(el) || r.test(v) || $.isNumeric(v);
							};
						$.validator.methods.min = function(v, el, p)
							{
								var f = el.id.match( /_\d+$/), e;

								if(f) e = $.fbuilder['forms'][f[0]].getItem(el.name);
								if(e) v = e.val();
								return this.optional(el) || v >= p;
							};
						$.validator.methods.max = function(v, el, p)
							{
								var f = el.id.match( /_\d+$/), e;

								if(f) e = $.fbuilder['forms'][f[0]].getItem(el.name);
								if(e) v = e.val();

								return this.optional(el) || v <= p;
							};
					}
				},
			val:function(raw)
				{
					raw = raw || false;
					var e = $( '[id="' + this.name + '"]:not(.ignore)' );
					if( e.length )
					{
						var v = $.trim( e.val() );
						if(raw) return ($.isNumeric(v) && this.thousandSeparator != '.') ? v : $.fbuilder.parseValStr(v, raw);
						return $.fbuilder.parseVal(v, this.thousandSeparator, this.decimalSymbol);
					}
					return 0;
				}
		}
	);