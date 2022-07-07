function foo() {
	let data = {
		"id": gV(gI("id")),
		"usuario": gV(gI("usuario")),
		"cpf": gV(gI("cpf")),
		"email": gV(gI("email")),
		"senha": gV(gI("senha")),
		"foto": gV(gI("foto-base64")),
		"access_token": gV(gI("access_token")),
		"access_token_expiration": gV(gI("access_token_expiration")),
		"password_token": gV(gI("password_token")),
		"password_token_expiration": gV(gI("password_token_expiration")),
		"activation_token": gV(gI("activation_token")),
		"activation_token_expiration": gV(gI("activation_token_expiration")),
		"situacoes_registrosInput": {
			"id": gV(gI("situacao_registro"))
		},
		"perfisInput": {
			"id": gV(gI("perfil"))
		}
	};
	request("POST", dv_gateway + "/usuarios", "", data, "controllerResponse", true, getCookie(gz_project));
}
			
{
	"form": [
		[
			{
				"label": "id",
				"type": "input",
				"id": "id",
				"class": "dv-integer dv-required"
			}
		],
		[
			{
				"label": "usuario",
				"type": "input",
				"id": "usuario",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "cpf",
				"type": "input",
				"id": "cpf",
				"class": "dv-cpf dv-required"
			}
		],
		[
			{
				"label": "email",
				"type": "input",
				"id": "email",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "senha",
				"type": "input",
				"id": "senha",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "foto",
				"type": "photo",
				"id": "foto",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "access_token",
				"type": "input",
				"id": "access_token",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "access_token_expiration",
				"type": "input",
				"id": "access_token_expiration",
				"class": "dv-datetime dv-required"
			}
		],
		[
			{
				"label": "password_token",
				"type": "input",
				"id": "password_token",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "password_token_expiration",
				"type": "input",
				"id": "password_token_expiration",
				"class": "dv-datetime dv-required"
			}
		],
		[
			{
				"label": "activation_token",
				"type": "input",
				"id": "activation_token",
				"class": "dv-required"
			}
		],
		[
			{
				"label": "activation_token_expiration",
				"type": "input",
				"id": "activation_token_expiration",
				"class": "dv-datetime dv-required"
			}
		],
		[
			{
				"label": "situacao_registro",
				"type": "select",
				"id": "situacao_registro",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "situacao_registro 1"
					},
					{
						"value": 2,
						"content": "situacao_registro 2"
					}
				]
			}
		],
		[
			{
				"label": "perfil",
				"type": "select",
				"id": "perfil",
				"class": "dv-required",
				"options": [
					{
						"value": 1,
						"content": "perfil 1"
					},
					{
						"value": 2,
						"content": "perfil 2"
					}
				]
			}
		]
	]
}