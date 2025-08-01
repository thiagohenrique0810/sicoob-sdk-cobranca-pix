Cobrança Bancária
[ Base URL: https://api.sicoob.com.br/cobranca-bancaria/v3 ]
A Cobrança Bancária Sicoob é um conjunto de serviços oferecidos a seus associados para recebimento de valores referentes às vendas de produtos e serviços da sua empresa, por meio de boletos de cobrança, pagos em toda a rede bancária. Esta API disponibiliza funcionalidades que auxiliam na gestão da carteira registrada, tornando viável todo o processo de acompanhamento, desde a inclusão de novos boletos, alteração de informações relevantes, protesto/negativação de títulos vencidos e não pagos, até a liquidação ou baixa do título.
Boleto
Inclusão e Manutenção de Boleto Bancário.



POST
/boletos
Incluir boletos
Serviço para a inclusão de boletos. É possível a inclusão de 1 boleto por requisição.

Parameters
Name	Description
boleto *
object
(body)
Inclusão das informações detalhadas do boleto de cobrança.

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1,
  "numeroContaCorrente": 0,
  "codigoEspecieDocumento": "DM",
  "dataEmissao": "2018-09-20",
  "nossoNumero": 2588658,
  "seuNumero": "1235512",
  "identificacaoBoletoEmpresa": "4562",
  "identificacaoEmissaoBoleto": 1,
  "identificacaoDistribuicaoBoleto": 1,
  "valor": 156.23,
  "dataVencimento": "2018-09-20",
  "dataLimitePagamento": "2018-09-20",
  "valorAbatimento": 1,
  "tipoDesconto": 1,
  "dataPrimeiroDesconto": "2018-09-20",
  "valorPrimeiroDesconto": 1,
  "dataSegundoDesconto": "2018-09-20",
  "valorSegundoDesconto": 0,
  "dataTerceiroDesconto": "2018-09-20",
  "valorTerceiroDesconto": 0,
  "tipoMulta": 1,
  "dataMulta": "2018-09-20",
  "valorMulta": 5,
  "tipoJurosMora": 1,
  "dataJurosMora": "2018-09-20",
  "valorJurosMora": 4,
  "numeroParcela": 1,
  "aceite": true,
  "codigoNegativacao": 2,
  "numeroDiasNegativacao": 60,
  "codigoProtesto": 1,
  "numeroDiasProtesto": 30,
  "pagador": {
    "numeroCpfCnpj": "98765432185",
    "nome": "Marcelo dos Santos",
    "endereco": "Rua 87 Quadra 1 Lote 1 casa 1",
    "bairro": "Santa Rosa",
    "cidade": "Luziânia",
    "cep": "72320000",
    "uf": "DF",
    "email": "pagador@dominio.com.br"
  },
  "beneficiarioFinal": {
    "numeroCpfCnpj": "98784978699",
    "nome": "Lucas de Lima"
  },
  "mensagensInstrucao": [
    "Descrição da Instrução 1",
    "Descrição da Instrução 2",
    "Descrição da Instrução 3",
    "Descrição da Instrução 4",
    "Descrição da Instrução 5"
  ],
  "gerarPdf": false,
  "rateioCreditos": [
    {
      "numeroBanco": 756,
      "numeroAgencia": 4027,
      "numeroContaCorrente": 0,
      "contaPrincipal": true,
      "codigoTipoValorRateio": 1,
      "valorRateio": 100,
      "codigoTipoCalculoRateio": 1,
      "numeroCpfCnpjTitular": "98765432185",
      "nomeTitular": "Marcelo dos Santos",
      "codigoFinalidadeTed": 10,
      "codigoTipoContaDestinoTed": "CC",
      "quantidadeDiasFloat": 1,
      "dataFloatCredito": "2020-12-30"
    }
  ],
  "codigoCadastrarPIX": 1,
  "numeroContratoCobranca": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Solicitação recebida com sucesso.

Example Value
Model
{
  "resultado": {
    "numeroCliente": 25546454,
    "codigoModalidade": 1,
    "numeroContaCorrente": 0,
    "codigoEspecieDocumento": "DM",
    "dataEmissao": "2018-09-20",
    "nossoNumero": 0,
    "seuNumero": "1235512",
    "identificacaoBoletoEmpresa": "4562",
    "codigoBarras": "",
    "linhaDigitavel": "",
    "identificacaoEmissaoBoleto": 1,
    "identificacaoDistribuicaoBoleto": 1,
    "valor": 156.23,
    "dataVencimento": "2018-09-20",
    "dataLimitePagamento": "2018-09-20",
    "valorAbatimento": 1,
    "tipoDesconto": 1,
    "dataPrimeiroDesconto": "2018-09-20",
    "valorPrimeiroDesconto": 1,
    "dataSegundoDesconto": "2018-09-20",
    "valorSegundoDesconto": 0,
    "dataTerceiroDesconto": "2018-09-20",
    "valorTerceiroDesconto": 0,
    "tipoMulta": 1,
    "dataMulta": "2018-09-20",
    "valorMulta": 5,
    "tipoJurosMora": 1,
    "dataJurosMora": "2018-09-20",
    "valorJurosMora": 4,
    "numeroParcela": 1,
    "aceite": true,
    "codigoNegativacao": 2,
    "numeroDiasNegativacao": 60,
    "codigoProtesto": 1,
    "numeroDiasProtesto": 30,
    "quantidadeDiasFloat": 2,
    "pagador": {
      "numeroCpfCnpj": "98765432185",
      "nome": "Marcelo dos Santos",
      "endereco": "Rua 87 Quadra 1 Lote 1 casa 1",
      "bairro": "Santa Rosa",
      "cidade": "Luziânia",
      "cep": "72320000",
      "uf": "DF",
      "email": "pagador@dominio.com.br"
    },
    "beneficiarioFinal": {
      "numeroCpfCnpj": "98784978699",
      "nome": "Lucas de Lima"
    },
    "mensagensInstrucao": [
      "Descrição da Instrução 1",
      "Descrição da Instrução 2",
      "Descrição da Instrução 3",
      "Descrição da Instrução 4",
      "Descrição da Instrução 5"
    ],
    "rateioCreditos": [
      {
        "numeroBanco": 756,
        "numeroAgencia": 4027,
        "numeroContaCorrente": 0,
        "contaPrincipal": true,
        "codigoTipoValorRateio": 1,
        "valorRateio": 100,
        "codigoTipoCalculoRateio": 1,
        "numeroCpfCnpjTitular": "98765432185",
        "nomeTitular": "Marcelo dos Santos",
        "codigoFinalidadeTed": 10,
        "codigoTipoContaDestinoTed": "CC",
        "quantidadeDiasFloat": 1,
        "dataFloatCredito": "2020-12-30"
      }
    ],
    "pdfBoleto": "JVBERi0xLjQKJeLjz9MKMyAwIG9iago8PC9UeXBlL1hPYmplY3QvU3VidHlwZS9JbWFnZS9XaWR0aCA1Nzgv+PgolaVRleHQtNS41LjExCnN0YXJ0eHJlZgoyNzAxOQolJUVPRgo=",
    "qrCode": "00020101021226950014br.gov.bcb.pix2573pix.sicoob.com.br/qr/payload/v2/cobv/e736df1b-1389-4b96-a070-c8dddac768de5204000053039865802BR5924JULIO PEREIRA DE OLIVEIRA6008Brasilia62070503***630435A3",
    "numeroContratoCobranca": 1,
    "descricaoRejeicaoPix": "Modalidade não permitida para geração de QR Code."
  }
}
400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/boletos
Consultar boleto
Serviço para consulta de um boleto bancário. Utiliza as informações do beneficiário logado (número da cooperativa, número identificador do beneficiário e conta corrente), juntamente com a informação do identificador do boleto (nosso número), ou da linha digitável ou do código de barras.

Parameters
Name	Description
numeroCliente *
integer
(query)
Número que identifica o contrato do beneficiário no Sisbr.

numeroCliente
codigoModalidade *
integer
(query)
Identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
3 - CAUCIONADA
4 - VINCULADA
5 - CARNÊ DE PAGAMENTOS
6 - INDEXADA
8 - COBRANÇA CONTA CAPITAL
codigoModalidade
nossoNumero
integer
(query)
Número identificador do boleto no Sisbr. Caso seja infomado, não é necessário infomar a linha digitável ou código de barras.

nossoNumero
linhaDigitavel
string
(query)
Número da linha digitável do boleto com 47 posições. Caso seja informado, não é necessário informar o nosso número ou código de barras.

linhaDigitavel
codigoBarras
string
(query)
Número de código de barras do boleto com 44 posições.Caso seja informado, não é necessário informar o nosso número ou linha digitável.

codigoBarras
numeroContratoCobranca
integer($int32)
(query)
Indicar o id do contatro de cobrança

numeroContratoCobranca
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Example Value
Model
{
  "resultado": {
    "numeroCliente": 25546454,
    "codigoModalidade": 1,
    "numeroContaCorrente": 0,
    "codigoEspecieDocumento": "DM",
    "dataEmissao": "2018-09-20",
    "nossoNumero": 0,
    "seuNumero": "1235512",
    "identificacaoBoletoEmpresa": "4562",
    "codigoBarras": "",
    "linhaDigitavel": "",
    "identificacaoEmissaoBoleto": 1,
    "identificacaoDistribuicaoBoleto": 1,
    "valor": 156.23,
    "dataVencimento": "2018-09-20",
    "dataLimitePagamento": "2018-09-20",
    "valorAbatimento": 1,
    "tipoDesconto": 1,
    "dataPrimeiroDesconto": "2018-09-20",
    "valorPrimeiroDesconto": 1,
    "dataSegundoDesconto": "2018-09-20",
    "valorSegundoDesconto": 0,
    "dataTerceiroDesconto": "2018-09-20",
    "valorTerceiroDesconto": 0,
    "tipoMulta": 1,
    "dataMulta": "2018-09-20",
    "valorMulta": 5,
    "tipoJurosMora": 1,
    "dataJurosMora": "2018-09-20",
    "valorJurosMora": 4,
    "numeroParcela": 1,
    "aceite": true,
    "codigoNegativacao": 2,
    "numeroDiasNegativacao": 60,
    "codigoProtesto": 1,
    "numeroDiasProtesto": 30,
    "quantidadeDiasFloat": 2,
    "pagador": {
      "numeroCpfCnpj": "98765432185",
      "nome": "Marcelo dos Santos",
      "endereco": "Rua 87 Quadra 1 Lote 1 casa 1",
      "bairro": "Santa Rosa",
      "cidade": "Luziânia",
      "cep": "72320000",
      "uf": "DF",
      "email": "pagador@dominio.com.br"
    },
    "beneficiarioFinal": {
      "numeroCpfCnpj": "98784978699",
      "nome": "Lucas de Lima"
    },
    "mensagensInstrucao": [
      "Descrição da Instrução 1",
      "Descrição da Instrução 2",
      "Descrição da Instrução 3",
      "Descrição da Instrução 4",
      "Descrição da Instrução 5"
    ],
    "listaHistorico": [
      {
        "dataHistorico": "2019-05-31",
        "tipoHistorico": "1",
        "descricaoHistorico": "TARIFA - TAR. MANUTENÇÃO DE TÍTULO VENCIDO - R$ 0,75"
      }
    ],
    "situacaoBoleto": "Em Aberto",
    "rateioCreditos": [
      {
        "numeroBanco": 756,
        "numeroAgencia": 4027,
        "numeroContaCorrente": 0,
        "contaPrincipal": true,
        "codigoTipoValorRateio": 1,
        "valorRateio": 100,
        "codigoTipoCalculoRateio": 1,
        "numeroCpfCnpjTitular": "98765432185",
        "nomeTitular": "Marcelo dos Santos",
        "codigoFinalidadeTed": 10,
        "codigoTipoContaDestinoTed": "CC",
        "quantidadeDiasFloat": 1,
        "dataFloatCredito": "2020-12-30"
      }
    ],
    "qrCode": "00020101021226950014br.gov.bcb.pix2573pix.sicoob.com.br/qr/payload/v2/cobv/e736df1b-1389-4b96-a070-c8dddac768de5204000053039865802BR5924JULIO PEREIRA DE OLIVEIRA6008Brasilia62070503***630435A3",
    "numeroContratoCobranca": 1
  }
}
204	
A requisição foi processada com êxito e não está retornando conteúdo.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/pagadores/{numeroCpfCnpj}/boletos
Listar Boletos por Pagador
Serviço para listagem de boletos por Pagador.

Parameters
Name	Description
numeroCpfCnpj *
string
(path)
CPF ou CNPJ do pagador. Tamanho máximo 14

numeroCpfCnpj
numeroCliente *
integer
(query)
Número que identifica o contrato do beneficiário no Sisbr.

numeroCliente
codigoSituacao
integer
(query)
Código da Situação do Boleto.

1 Em Aberto
2 Baixado
3 Liquidado
codigoSituacao
dataInicio
string($date)
(query)
Data de Vencimento Inicial.
Formato: yyyy-MM-dd

dataInicio
dataFim
string($date)
(query)
Data de Vencimento Final.
Formato: yyyy-MM-dd

dataFim
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Example Value
Model
{
  "resultado": [
    {
      "numeroCliente": 25546454,
      "codigoModalidade": 1,
      "numeroContaCorrente": 0,
      "codigoEspecieDocumento": "DM",
      "dataEmissao": "2018-09-20",
      "nossoNumero": 0,
      "seuNumero": "1235512",
      "identificacaoBoletoEmpresa": "4562",
      "codigoBarras": "",
      "linhaDigitavel": "",
      "valor": 156.23,
      "dataVencimento": "2018-09-20",
      "valorAbatimento": 1,
      "tipoDesconto": 0,
      "dataPrimeiroDesconto": "2018-09-20",
      "valorPrimeiroDesconto": 1,
      "dataSegundoDesconto": "2018-09-20",
      "valorSegundoDesconto": 0,
      "dataTerceiroDesconto": "2018-09-20",
      "valorTerceiroDesconto": 0,
      "tipoMulta": 1,
      "dataMulta": "2018-09-20",
      "valorMulta": 5,
      "tipoJurosMora": 1,
      "dataJurosMora": "2018-09-20",
      "valorJurosMora": 4,
      "numeroParcela": 1,
      "aceite": true,
      "codigoNegativacao": 2,
      "codigoProtesto": 1,
      "quantidadeDiasFloat": 2,
      "pagador": {
        "numeroCpfCnpj": "98765432185",
        "nome": "Marcelo dos Santos"
      },
      "beneficiarioFinal": {
        "nome": "Lucas de Lima"
      },
      "mensagensInstrucao": [
        "Descrição da Instrução 1",
        "Descrição da Instrução 2",
        "Descrição da Instrução 3",
        "Descrição da Instrução 4",
        "Descrição da Instrução 5"
      ],
      "situacaoBoleto": "Liquidado",
      "qrCode": "00020101021226950014br.gov.bcb.pix2573pix.sicoob.com.br/qr/payload/v2/cobv/e736df1b-1389-4b96-a070-c8dddac768de5204000053039865802BR5924JULIO PEREIRA DE OLIVEIRA6008Brasilia62070503***630435A3",
      "numeroContratoCobranca": 1
    }
  ]
}
204	
A requisição foi processada com êxito e não está retornando conteúdo.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/boletos/segunda-via
Emitir segunda via de um boleto
Serviço para emissão da segunda via de boleto já registrado. Utiliza as informações do beneficiário logado (número da cooperativa, número identificador do beneficiário e conta corrente), juntamente com a informação do identificador do boleto (nosso número), ou da linha digitável ou do código de barras. Quando informados código de barras ou linha digitável, a pesquisa é realiazada prioritariamente por estes parâmetros.

Parameters
Name	Description
numeroCliente *
integer
(query)
Número que identifica o contrato do beneficiário no Sisbr.

numeroCliente
codigoModalidade *
integer
(query)
Identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
3 - CAUCIONADA
4 - VINCULADA
5 - CARNÊ DE PAGAMENTOS
6 - INDEXADA
8 - COBRANÇA CONTA CAPITAL
codigoModalidade
nossoNumero
integer
(query)
Número identificador do boleto no Sisbr.Caso seja informado, não é necessário informar a linha digitável ou código de barras.

nossoNumero
linhaDigitavel
string
(query)
Número da linha digitável do boleto com 47 posições.Caso seja informado, não é necessário informar o nosso número ou código de barras.

linhaDigitavel
codigoBarras
string
(query)
Número de código de barras do boleto com 44 posições.Caso seja informado, não é necessário informar o nosso número ou a linha digitável.

codigoBarras
gerarPdf
boolean
(query)
Identificador para o sistema devolver ou não o PDF do Boleto. O PDF será retornado na Base64.


--
numeroContratoCobranca
integer($int64)
(query)
Indicar o id do contatro de cobrança

numeroContratoCobranca
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Example Value
Model
{
  "resultado": {
    "numeroCliente": 25546454,
    "codigoModalidade": 1,
    "codigoEspecieDocumento": "DM",
    "dataEmissao": "2018-09-20",
    "nossoNumero": 0,
    "seuNumero": "1235512",
    "codigoBarras": "",
    "linhaDigitavel": "",
    "valor": 156.23,
    "dataVencimento": "2018-09-20",
    "valorAbatimento": 1,
    "numeroParcela": 1,
    "aceite": true,
    "tipoMulta": 1,
    "valorMulta": 5.01,
    "tipoJurosMora": 1,
    "valorJurosMora": 4,
    "pagador": {
      "numeroCpfCnpj": "98765432185",
      "nome": "Marcelo dos Santos",
      "endereco": "Rua 87 Quadra 1 Lote 1 casa 1",
      "bairro": "Santa Rosa",
      "cidade": "Luziânia",
      "cep": "72320000",
      "uf": "DF",
      "email": "pagador@dominio.com.br"
    },
    "beneficiarioFinal": {
      "numeroCpfCnpj": "98784978699",
      "nome": "Lucas de Lima"
    },
    "mensagensInstrucao": [
      "Descrição da Instrução 1",
      "Descrição da Instrução 2",
      "Descrição da Instrução 3",
      "Descrição da Instrução 4",
      "Descrição da Instrução 5"
    ],
    "pdfBoleto": "JVBERi0xLjQKJeLjz9MKMyAwIG9iago8PC9UeXBlL1hPYmplY3QvU3VidHlwZS9JbWFnZS9XaWR0aCA1Nzgv+PgolaVRleHQtNS41LjExCnN0YXJ0eHJlZgoyNzAxOQolJUVPRgo=",
    "qrCode": "00020101021226950014br.gov.bcb.pix2573pix.sicoob.com.br/qr/payload/v2/cobv/e736df1b-1389-4b96-a070-c8dddac768de5204000053039865802BR5924JULIO PEREIRA DE OLIVEIRA6008Brasilia62070503***630435A3",
    "numeroContratoCobranca": 1
  }
}
204	
A requisição foi processada com êxito e não está retornando conteúdo.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/boletos/faixas-nosso-numero
Consulta de dados de faixas de nosso número disponíveis.
Serviço para consulta de dados de faixas de nosso número disponíveis.
Quando o campo validaDigitoVerificadorNossoNumero retornar o valor "0" a faixa "numeroInicial" e "numeroFinal" refere-se a numeração final (exemplo: 10 e 15 - utilização: 1-0 1-1 1-2 1-3 1-4 1-5).
Mas se o campo validaDigitoVerificadorNossoNumero retornar o valor "1" a faixa "numeroInicial" e "numeroFinal" deverá ser calculado o DV (exemplo: 10 e 15 - utilização: 10-4 11-8 12-0 13-1 14-7 15-9).

Parameters
Name	Description
numeroCliente *
integer
(query)
Número que identifica o contrato do beneficiário no Sisbr.

numeroCliente
codigoModalidade *
integer
(query)
Identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
3 - CAUCIONADA
4 - VINCULADA
8 - COBRANÇA CONTA CAPITAL
codigoModalidade
quantidade *
integer
(query)
Quantidade mínima de nosso números que devem estar disponíveis na faixa a ser pesquisada.

quantidade
numeroContratoCobranca
integer($int64)
(query)
Indicar o id do contatro de cobrança

numeroContratoCobranca
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Example Value
Model
{
  "resultado": [
    {
      "numeroCliente": 5224,
      "nome": "JOSE PEREIRA",
      "codigoModalidade": 1,
      "numeroInicial": 1,
      "numeroFinal": 10,
      "quantidade": 10,
      "numeroContratoCobranca": 1,
      "validaDigitoVerificadorNossoNumero": true
    }
  ]
}
204	
A requisição foi processada com êxito e não está retornando conteúdo.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

PATCH
/boletos/{nossoNumero}
Alterar dados de um boleto
Serviço para alteração de dados de boleto já registrado. Deve ser feita a alteração de somente um objeto do boleto por requisição.
Objetos de alteração do boleto:

seuNumero
desconto
abatimento
multa
jurosMora
rateioCredito
pix
prorrogacaoVencimento
prorrogacaoLimitePagamento
Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boleto *
object
(body)
Informações do boleto de cobrança

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1,
  "numeroContratoCobranca": 1,
  "especieDocumento": {
    "codigoEspecieDocumento": "DM"
  },
  "seuNumero": {
    "seuNumero": "209",
    "identificacaoBoletoEmpresa": "209"
  },
  "desconto": {
    "tipoDesconto": 1,
    "dataPrimeiroDesconto": "2018-09-20",
    "valorPrimeiroDesconto": 1,
    "dataSegundoDesconto": "2018-09-20",
    "valorSegundoDesconto": 0,
    "dataTerceiroDesconto": "2018-09-20",
    "valorTerceiroDesconto": 0
  },
  "abatimento": {
    "valorAbatimento": 156.23
  },
  "multa": {
    "tipoMulta": 1,
    "dataMulta": "2018-09-20",
    "valorMulta": 5
  },
  "jurosMora": {
    "tipoJurosMora": 1,
    "dataJurosMora": "2018-09-20",
    "valorJurosMora": 4
  },
  "rateioCredito": {
    "tipoOperacao": 2,
    "rateioCreditos": [
      {
        "numeroBanco": 756,
        "numeroAgencia": 4027,
        "numeroContaCorrente": 0,
        "contaPrincipal": true,
        "codigoTipoValorRateio": 1,
        "valorRateio": 100,
        "codigoTipoCalculoRateio": 1,
        "numeroCpfCnpjTitular": "98765432185",
        "nomeTitular": "Marcelo dos Santos",
        "codigoFinalidadeTed": 10,
        "codigoTipoContaDestinoTed": "CC",
        "quantidadeDiasFloat": 1,
        "dataFloatCredito": "2020-12-30"
      }
    ]
  },
  "pix": {
    "utilizarPix": false
  },
  "prorrogacaoVencimento": {
    "dataVencimento": "2018-09-20"
  },
  "prorrogacaoLimitePagamento": {
    "dataLimitePagamento": "2018-09-20"
  },
  "valorNominal": {
    "valor": 156.23
  }
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Alteração realizada com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

POST
/boletos/{nossoNumero}/baixar
Comandar a baixa de boletos
Serviço para comandar a baixa de boletos informados.

Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boleto *
object
(body)
Informações do boleto de cobrança

Example Value
Model
{
  "numeroCliente": 5224,
  "codigoModalidade": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
Pagador
Inclusão e Manutenção de Pagador.



PUT
/pagadores
Alterar informações do cadastro do pagador.
Serviço para alterar informações do cadastro do pagador.

Parameters
Name	Description
pagador *
object
(body)
Informações do pagador.

Example Value
Model
{
  "numeroCliente": 25546454,
  "numeroCpfCnpj": "98765432185",
  "nome": "Marcelo dos Santos",
  "endereco": "Rua 87 Quadra 1 Lote 1 casa 1",
  "bairro": "Santa Rosa",
  "cidade": "Luziânia",
  "cep": "72320000",
  "uf": "DF",
  "email": "pagador@dominio.com.br"
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
Negativação
Negativação de Boleto Bancário Vencido e Não Pago.



POST
/boletos/{nossoNumero}/negativacoes
Negativar pagadores de boletos
Serviço para indicar a negativação de pagadores de boletos informados. A negativação é o registro de pendências ou restrições nos órgãos de proteção ao crédito. No Sicoob, o parceiro para este serviço é o SERASA.

Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boletos *
object
(body)
Informações do boleto de cobrança.

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

PATCH
/boletos/{nossoNumero}/negativacoes
Cancelar o apontamento da negativação de pagadores de boletos
Serviço para cancelar o apontamento da negativação de pagadores de boletos informados. O boleto não será enviado ao serviço de proteção ao crédito.

Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boleto *
object
(body)
Informações do boleto.

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

DELETE
/boletos/{nossoNumero}/negativacoes
Baixar a negativação de pagadores de boletos
Serviço para comandar uma baixa da negativação de pagadores de boletos informados. Será enviado um pedido de baixa para o serviço de proteção ao crédito.

Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boleto *
object
(body)
Informações do boleto de cobrança.

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
Protesto
Protesto de Boleto Bancário Vencido e Não Pago.



POST
/boletos/{nossoNumero}/protestos
Protestar boletos
Este serviço registra a indicação a protesto de boletos informados. Os boletos vencidos e não pagos podem ser protestados e registrados em cartório.

Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boletos *
object
(body)
Informações do boleto bancário.

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

PATCH
/boletos/{nossoNumero}/protestos
Cancelar o apontamento de protesto de boletos
Este serviço realiza a indicação de cancelamento de protesto de boletos informados. Os boletos em atraso e não pagos podem ser indicados a protesto. Caso seja realizado no mesmo dia, pode-se cancelar o apontamento a protesto.

Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boleto *
object
(body)
Informações do boleto bancário.

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

DELETE
/boletos/{nossoNumero}/protestos
Desistir do protesto de boletos
Este serviço realiza o pedido de desistência do protesto de boletos informados. O pedido de desistência não garante que o protesto será retirado. Deve-se aguardar o retorno do cartório. O pedido de desistência pode ser realizado a qualquer momento, desde que haja um apontamento prévio.

Parameters
Name	Description
nossoNumero *
integer
(path)
Número que identifica o boleto de cobrança no Sisbr

nossoNumero
boleto *
object
(body)
Informações do boleto de cobrança.

Example Value
Model
{
  "numeroCliente": 25546454,
  "codigoModalidade": 1
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Solicitação recebida com sucesso.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
Movimentação
Gestão da Carteira de Cobrança Bancária.



POST
/boletos/movimentacoes
Solicitar a movimentação da carteira de cobrança registrada para beneficiário informado
Serviço para solicitar a movimentação da carteira de cobrança registrada para beneficiário informado. Os movimentos disponíveis para solicitaçao são 1. Entrada 2. Prorrogação 3. A Vencer 4. Vencido 5. Liquidação 6. Baixa

As consultas estão limitadas em um período máximo de 2 dias.
Parameters
Name	Description
solicitacao *
object
(body)
Informações da solicitação de movimentação de cobrança.

Example Value
Model
{
  "numeroCliente": 25546454,
  "tipoMovimento": 1,
  "dataInicial": "2018-09-20",
  "dataFinal": "2018-09-20"
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
201	
Example Value
Model
{
  "resultado": {
    "mensagem": "Solicitação recebida com sucesso. Utilize o 'Código da Solicitação' para verificar se já foi processada.",
    "codigoSolicitacao": 132
  }
}
400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/boletos/movimentacoes
Consultar a situação da solicitação da movimentação
Serviço para consultar a situação da solicitação da movimentação.

Parameters
Name	Description
numeroCliente *
integer
(query)
Número que identifica o contrato do beneficiário no Sisbr.

numeroCliente
codigoSolicitacao *
integer
(query)
Código da solicitação que deseja consultar a quantidade de arquivos que serão gerados

codigoSolicitacao
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Example Value
Model
{
  "resultado": {
    "quantidadeTotalRegistros": "1.500.000",
    "quantidadeRegistrosArquivo": 500000,
    "quantidadeArquivo": 3,
    "idArquivos": [
      30025254,
      30025255,
      30025256
    ]
  }
}
204	
A requisição foi processada com êxito e não está retornando conteúdo.

400	
Possíveis erros de negócio.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/boletos/movimentacoes/download
Download do(s) arquivo(s) de movimentação.
Serviço para obter um arquivo de movimentação.

Parameters
Name	Description
numeroCliente *
integer
(query)
Número que identifica o contrato do beneficiário no Sisbr.

numeroCliente
codigoSolicitacao *
integer
(query)
Código da solicitação que deseja consultar a quantidade de arquivos que serão gerados

codigoSolicitacao
idArquivo *
integer
(query)
ID do arquivo para download

idArquivo
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Example Value
Model
{
  "resultado": {
    "arquivo": "UEsDBBQAAAAIAMOUwp3Ci05RwpzCqzLDsQEAAMO5GwAAMAAAAEVOVFJfMzA2Nl8xODkxODlfMjAxOTA0MTAxODE0NDQzMjQ1MTM0XzI2XzAuanNvbsOtw5bDkWvDnCAYAMOwf2XDpDkZwp9GwqPDqcObw5rCu8Kxw4HCtcKUw7UowowxwoZEdwhJLCbDqcOLw5jDvz7Do13DmzBCw6NDS0pRcsOHw4V8w4bDr8OTH8KHP8O+JFrDnsKYWlfCuhfClTDDl8OWVMKqw6tEwqPDmsOeXMKae8OtfyRnwpjCpUk7NMKfDnbCuBPCpz5IwpPDisOIwr3CvsKbBsKiNMOpw7TCoRbCk8KuZHvCtcO/wpbCpMKJFMK9w7jDmsK6wpnDjMO0IQbDhDMoMwx7woAzf2XCkMK7w6/Dk8KIw4/CusKZDcOHw7PDoV/CjBVzw7U8DS8zIBlCw78Pw7fDtV3DlMOaBSpXBi/DnXXDrDNtb8KFG8O9w5jCqcOlwqXCkcKiw5ZSSMOlJsKQwoN/w6jCg8O3wrofanfCl1NUwrjChFRXw53CqMOhamjClB1nw5/CuHvDtzbCk8OtNsK7U8K+wrfCqsKtwo7DhcO5wqFPOcOSDMONwqzDiMK9wqjCjX3CiMOkw7QjwrjDpsK3QR/DjMK5wrBWdMOuBcKMFiVjHBPDsMKNUwDClENRAMKCYwljw6/CmMKhw6s/wqYxbsOXdixTwopJAmx+wonCt8KNditqNsKmGkI3ccKnG8OdwqtrccOwG8OxfMKRwo/Ciy4uwozCtcKnw60gGGN4KF9Yw717CgzDvDLDvE3Co8OlV8KywozDs1Utw5Nlw4s4wo/ClsKjw6UQw4s5wqxqOV/CtsKcQ8K0HC3Ch1gmfFXDi2jDmTLDocORcsK0HGLCmcOSwrduwpnDkmg5Wg7CsVzDoFUtw7Nlw4sFwo7ClsKjw6UQw4tsw53Ds3LDgMO/MsKLw6fDpWg5w4gyZ8KrWibDi8KWOcKLwpbCo8OlEMOLJVnDlTJewrZcwpJoOVoOwrBcw7DCmTPDhsOtw67DvMOXZsO7w73Dg8OYXsOAMn7DrsKMw4EJdsKGw53Ch8KScsOOwrLDi8Owwp3CnTF+w74DUEsBAj8AFAAAAAgAw5TCncKLTlHCnMKrMsOxAQAAw7kbAAAwACQAAAAAAAAAIAAAAAAAAABFTlRSXzMwNjZfMTg5MTg5XzIwMTkwNDEwMTgxNDQ0MzI0NTEzNF8yNl8wLmpzb24KACAAAAAAAAEAGADCsMKtw6pswrjDsMOUAQDDr8OJwofDrsOvw5QBAMOvw4nCh8Ouw6/DlAFQSwUGAAAAAAEAAQDCggAAAD8CAAAAAA==",
    "nomeArquivo": "ENTR_3066_189189_201904260922011189887_47_0.zip"
  }
}
400	
Erro de negócio

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
Webhook
Webhook para notificação periódicas de eventos associados a diferentes tipos de movimento.



POST
/webhooks
Cadastrar um webhook para receber notificações de acordo com o tipo de movimento.
Este serviço permite cadastrar uma URL que será notificada sempre que ocorrer um evento associado a um tipo de movimento. O webhook pode ser configurado para o período de movimentação atual (D0).

Parameters
Name	Description
webhook *
object
(body)
Informações do webhook para o cadastro.

Example Value
Model
{
  "url": "https://webhook.com",
  "codigoTipoMovimento": 7,
  "codigoPeriodoMovimento": 1,
  "email": "string"
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
201	
Webhook cadastrado com sucesso.

Example Value
Model
{
  "resultado": {
    "idWebhook": 1234
  }
}
400	
Erro de negócio

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/webhooks
Consultar os webhooks cadastrados.
Serviço para consultar os detalhes dos webhooks cadastrados.

Parameters
Name	Description
idWebhook
integer($int64)
(query)
Identificador único do webhook.

idWebhook
codigoTipoMovimento
integer($int32)
(query)
Código do tipo de movimento do webhook.
7 - Pagamento (Baixa operacional)

codigoTipoMovimento
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Consulta realizada com sucesso.

Example Value
Model
{
  "resultado": [
    {
      "idWebhook": 4,
      "url": "https://webhook.com",
      "email": "webhook@email.com",
      "codigoTipoMovimento": 7,
      "descricaoTipoMovimento": "Pagamento (Baixa operacional)",
      "codigoPeriodoMovimento": 1,
      "descricaoPeriodoMovimento": "Movimento atual (D0)",
      "codigoSituacao": 3,
      "descricaoSituacao": "Validado com sucesso",
      "dataHoraCadastro": "2024-09-03T00:27:18.483Z",
      "dataHoraUltimaAlteracao": "2024-09-06T12:24:11.296Z",
      "dataHoraInativacao": "2024-09-05T18:50:55.099Z",
      "descricaoMotivoInativacao": "Erro ao enviar notificação"
    }
  ]
}
204	
A consulta foi realizada com sucesso e não retornou registros.

400	
Erro de negócio

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

PATCH
/webhooks/{idWebhook}
Atualizar um webhook cadastrado.
Serviço de atualização de webhook. Ao modificar a URL, a situação do webhook será automaticamente alterada para '1 - Aguardando validação' e permanecerá assim até que a nova URL seja validada com sucesso.

Parameters
Name	Description
idWebhook *
integer($int64)
(path)
Identificador único do webhook.

idWebhook
webhook *
object
(body)
Informações do webhook para atualização.

Example Value
Model
{
  "url": "https://webhook.com",
  "email": "string"
}
Parameter content type

application/json
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Webhook atualizado com sucesso.

400	
Erro de negócio

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

DELETE
/webhooks/{idWebhook}
Excluir um webhook.
Serviço responsável por remover permanentemente um webhook registrado, encerrando o envio de notificações para a URL vinculada."

Parameters
Name	Description
idWebhook *
integer($int64)
(path)
Identificador único do webhook.

idWebhook
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Webhook excluído com sucesso.

400	
Erro de negócio

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

PATCH
/webhooks/{idWebhook}/reativar
Reativar um webhook inativo.
Serviço de reativação de webhook desativado, restabelecendo o recebimento de notificações. A situação do webhook será atualizada para '1 - Aguardando validação' e permanecerá assim até que a URL seja validada com sucesso.

Parameters
Name	Description
idWebhook *
integer($int64)
(path)
Identificador único do webhook.

idWebhook
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
204	
Webhook reativado com sucesso.

400	
Erro de negócio

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

GET
/webhooks/{idWebhook}/solicitacoes
Consultar solicitações de um webhook.
Consulta as solicitações de notificação para um webhook com base na data de solicitação informada.
Retorna o histórico das tentativas de notificação, incluindo o status e a resposta da requisição.

Parameters
Name	Description
idWebhook *
integer($int64)
(path)
Identificador único do webhook.

idWebhook
dataSolicitacao *
string($date)
(query)
Data da solicitação. Formato: yyyy-MM-dd

dataSolicitacao
pagina
integer($int32)
(query)
Número da página a ser consultada.

pagina
codigoSolicitacaoSituacao
integer($int32)
(query)
Código da situação da solicitação do webhook.

3 - Enviado com sucesso
6 - Erro no envio
codigoSolicitacaoSituacao
client_id *
string
(header)
ClientId utilizado na utilização do TOKEN

client_id
Responses
Response content type

application/json
Code	Description
200	
Consulta realizada com sucesso.

Example Value
Model
{
  "resultado": [
    {
      "paginalAtual": 1,
      "totalPaginas": 2,
      "totalRegistros": 100,
      "webhookSolicitacoes": [
        {
          "codigoWebhookSituacao": 3,
          "descricaoWebhookSituacao": "Validado com sucesso",
          "codigoSolicitacaoSituacao": 3,
          "descricaoSolicitacaoSituacao": "Enviado com sucesso",
          "codigoTipoMovimento": 7,
          "descricaoTipoMovimento": "Pagamento (Baixa operacional)",
          "codigoPeriodoMovimento": 1,
          "descricaoPeriodoMovimento": "Movimento atual (D0)",
          "descricaoErroProcessamento": "Erro ao enviar notificação",
          "dataHoraCadastro": "2024-09-04T15:43:56.000Z",
          "validacaoWebhook": false,
          "webhookNotificacoes": [
            {
              "url": "https://webhook.com",
              "dataHoraInicio": "2024-09-08T15:50:38.077Z",
              "dataHoraFim": "2024-09-08T15:51:38.077Z",
              "tempoComunicao": 60,
              "codigoStatusRequisicao": 200,
              "descricaoMensagemRetorno": "{\"messsage\":\"Webhook recebido com sucesso!\"}"
            }
          ]
        }
      ]
    }
  ]
}
400	
Erro de negócio

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
406	
Possíveis erros de inconsistência nos dados passados.

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}
500	
Erro interno

Example Value
Model
{
  "mensagens": [
    {
      "mensagem": "string",
      "codigo": "string"
    }
  ]
}

Models
Webhook{
idWebhook*	integer($int64)
example: 4
Identificador único do webhook

url*	string
example: https://webhook.com
URL do webhook. A URL deve ser https.

email	string
example: webhook@email.com
E-mail associado ao webhook

codigoTipoMovimento*	integer($int32)
example: 7
Código do tipo de movimento do webhook.
7 - Pagamento (Baixa operacional)

descricaoTipoMovimento*	string
example: Pagamento (Baixa operacional)
Descrição do tipo de movimento

codigoPeriodoMovimento*	integer($int32)
example: 1
Código do período de movimento

1 - Movimento atual (D0)
descricaoPeriodoMovimento*	string
example: Movimento atual (D0)
Descrição do período de movimento

codigoSituacao*	integer($int32)
example: 3
Código da situação do webhook

1 - Aguardando validação
2 - Validado com sucesso
3 - Inativo
descricaoSituacao*	string
example: Validado com sucesso
Descrição da situação

dataHoraCadastro*	string($date-time)
example: 2024-09-03T00:27:18.483Z
Data e hora de cadastro Formato: yyyy-MM-ddTHH:mm:ss.SSSZ

dataHoraUltimaAlteracao*	string($date-time)
example: 2024-09-06T12:24:11.296Z
Data e hora da última alteração Formato: yyyy-MM-ddTHH:mm:ss.SSSZ

dataHoraInativacao	string($date-time)
example: 2024-09-05T18:50:55.099Z
Data e hora de inativação Formato: yyyy-MM-ddTHH:mm:ss.SSSZ

descricaoMotivoInativacao	string
example: Erro ao enviar notificação
Descrição do motivo de inativação

}
WebhookCadastro{
url*	string
example: https://webhook.com
URL do webhook

codigoTipoMovimento*	integer($int32)
example: 7
Código do tipo de movimento do webhook.
7 - Pagamento (Baixa operacional)

codigoPeriodoMovimento*	integer($int32)
example: 1
Código do período de movimento

1 - Movimento atual (D0)
email	string
E-mail do associado

}
WebhookAlteracao{
url*	string
example: https://webhook.com
URL do webhook

email	string
Email associado ao webhook

}
WebhookSolicitacoes{
paginalAtual*	integer($int32)
example: 1
Número da página atual

totalPaginas*	integer($int32)
example: 2
Total de páginas

totalRegistros*	integer($int32)
example: 100
Total de registros

webhookSolicitacoes	[{...}]
}
Boleto{
numeroCliente*	integer($int32)
example: 25546454
Número que identifica o contrato do beneficiário no Sisbr.

codigoModalidade*	integer($int32)
example: 1
Número que identifica a modalidade do boleto. Infomar

1 - SIMPLES COM REGISTRO
numeroContaCorrente*	integer($int32)
Número da Conta Corrente onde será realizado o crédito da liquidação do boleto.

codigoEspecieDocumento*	string
example: DM
Espécie do Documento. Informar valores listados abaixo. Tamanho máximo 3

CH - Cheque
DM - Duplicata Mercantil
DMI - Duplicata Mercantil Indicação
DS - Duplicata de Serviço
DSI - Duplicata Serviço Indicação
DR - Duplicata Rural
LC - Letra de Câmbio
NCC - Nota de Crédito Comercial
NCE - Nota de Crédito Exportação
NCI - Nota de Crédito Industrial
NCR - Nota de Crédito Rural
NP - Nota Promissória
NPR - Nota Promissória Rural
TM - Triplicata Mercantil
TS - Triplicata de Serviço
NS - Nota de Seguro
RC - Recibo
FAT - Fatura
ND - Nota de Débito
AP - Apólice de Seguro
ME - Mensalidade Escolar
PC - Pagamento de Consórcio
NF - Nota Fiscal
DD - Documento de Dívida
CC - Cartão de Crédito
BDP - Boleto Proposta
OU - Outros
dataEmissao*	string($date)
example: 2018-09-20
Data de emissão do boleto. Caso não seja informado, o sistema atribui a data de registro do boleto no Sisbr.
Formato: yyyy-MM-dd

nossoNumero	integer($int32)
example: 2588658
Número que identifica o boleto de cobrança no Sisbr. Caso deseje, o beneficiário poderá informar o nossoNumero.

seuNumero*	string
example: 1235512
Número identificador do boleto no sistema do beneficiário. Tamanho máximo 18

identificacaoBoletoEmpresa	string
example: 4562
Campo destinado para uso da empresa do beneficiário para identificação do boleto. Tamanho máximo 25

identificacaoEmissaoBoleto*	integer
example: 1
Código de identificação de emissão do boleto. Informar os valores listados abaixo. - 1 Banco Emite - 2 Cliente Emite

identificacaoDistribuicaoBoleto*	integer
example: 1
Código de identificação de distribuição do boleto. Informar os valores listados abaixo. - 1 Banco Distribui - 2 Cliente Distribui

valor*	number($double)
example: 156.23
Valor nominal do boleto.

dataVencimento*	string($date)
example: 2018-09-20
Data de vencimento do boleto.
Formato: yyyy-MM-dd

dataLimitePagamento	string($date)
example: 2018-09-20
Data de limite para pagamento do boleto.
Formato: yyyy-MM-dd

valorAbatimento	number($double)
example: 1
Valor do abatimento a ser aplicado no boleto.

tipoDesconto*	integer($int64)
example: 1
Informar o tipo de desconto atribuido ao boleto.
- 0 Sem Desconto
- 1 Valor Fixo Até a Data Informada
- 2 Percentual até a data informada
- 3 Valor por antecipação dia corrido
- 4 Valor por antecipação dia útil
- 5 Percentual por antecipação dia corrido
- 6 Percentual por antecipação dia útil

dataPrimeiroDesconto	string($date)
example: 2018-09-20
Data do primeiro desconto.
Formato: yyyy-MM-dd

valorPrimeiroDesconto	number($double)
example: 1
Valor do primeiro desconto. Deve ser informado caso a data do primeiro desconto seja preenchida.

dataSegundoDesconto	string($date)
example: 2018-09-20
Data do segundo desconto.
Formato: yyyy-MM-dd

valorSegundoDesconto	number($double)
example: 0
Valor do segundo desconto. Deve ser informado caso a data do segundo desconto seja preenchida.

dataTerceiroDesconto	string($date)
example: 2018-09-20
Data do terceiro desconto.
Formato: yyyy-MM-dd

valorTerceiroDesconto	number($double)
example: 0
Valor do terceiro desconto.Deve ser preenchido caso a data do terceiro desconto seja preenchida.

tipoMulta*	integer
example: 1
Tipo de multa a ser aplicado no boleto. Informar os valores listados abaixo.

0 Isento
1 Valor Fixo
2 Percentual
dataMulta	string($date)
example: 2018-09-20
Deve ser maior que a data de vencimento do boleto e menor ou igual que data limite de pagamento.
Formato: yyyy-MM-dd

valorMulta	number($double)
example: 5
Valor da multa. Deve ser preenchido caso o campo dataMulta seja preenchido.

tipoJurosMora*	integer
example: 1
Tipo de juros de mora. Informar os valores listados abaixo.

1 Valor por dia
2 Taxa Mensal
3 Isento
dataJurosMora	string($date)
example: 2018-09-20
Deve ser maior que a data de vencimento do boleto e menor ou igual que data limite de pagamento.
Formato: yyyy-MM-dd

valorJurosMora	number($double)
example: 4
Valor do juros de mora. Deve ser preenchido caso o campo dataJurosMora seja preenchido.

numeroParcela*	integer($int64)
example: 1
Número da parcela do boleto.Valor máximo permitido '99'.

aceite	boolean
example: true
Identificador do aceite do boleto.

codigoNegativacao	integer
example: 2
Código de negativação do boleto. Informar os valores abaixo.

2 Negativar Dias Úteis
3 Não Negativar
numeroDiasNegativacao	integer
example: 60
Número de dias para negativação do boleto. Deve ser preenchido caso o campo codigoNegativacao seja igual a '2'.

codigoProtesto	integer
example: 1
Código de protesto do boleto. Informar os valores abaixo.

1 Protestar Dias Corridos
2 Protestar Dias Úteis
3 Não Protestar
numeroDiasProtesto	integer
example: 30
Número de dias para protesto do boleto. Deve ser preenchido caso o campo codigoProtesto seja '1'.

pagador*	{
numeroCpfCnpj*	[...]
nome*	[...]
endereco*	[...]
bairro*	[...]
cidade*	[...]
cep*	[...]
uf*	[...]
email	[...]
}
beneficiarioFinal	{
numeroCpfCnpj	[...]
nome	[...]
}
mensagensInstrucao	[
example: List [ "Descrição da Instrução 1", "Descrição da Instrução 2", "Descrição da Instrução 3", "Descrição da Instrução 4", "Descrição da Instrução 5" ]
[...]]
gerarPdf	boolean
example: false
Identificador para o sistema devolver ou não o PDF do Boleto. O PDF será retornado na Base64.

rateioCreditos	[RateioCredito{...}]
codigoCadastrarPIX	integer($int16)
example: 1
Indicar uma das opções

0 Padrão
1 Com Pix
2 Sem Pix
numeroContratoCobranca	integer($int64)
example: 1
Indicar o id do contatroCobranca

}
Negativacao{
numeroCliente*	integer($int32)
example: 25546454
Número que identifica o contrato do beneficiário no Sisbr.

codigoModalidade*	number
example: 1
Número que identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
5 - CARNÊ DE PAGAMENTOS
}
Protesto{
numeroCliente*	integer($int32)
example: 25546454
Número que identifica o contrato do beneficiário no Sisbr.

codigoModalidade*	number
example: 1
Número que identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
3 - CAUCIONADA
4 - VINCULADA
5 - CARNÊ DE PAGAMENTOS
6 - INDEXADA
8 - COBRANÇA CONTA CAPITAL
}
Pagador{
numeroCliente*	integer($int32)
example: 25546454
Número que identifica o contrato do beneficiário.

numeroCpfCnpj*	string
example: 98765432185
CPF ou CNPJ do pagador do boleto de cobrança. Tamanho máximo 14

nome*	string
example: Marcelo dos Santos
Nome completo do pagador do boleto de cobrança. Tamanho máximo 50

endereco*	string
example: Rua 87 Quadra 1 Lote 1 casa 1
Endereço do pagador do boleto de cobrança.

bairro*	string
example: Santa Rosa
Bairro do pagador do boleto de cobrança.

cidade*	string
example: Luziânia
Cidade do pagador do boleto de cobrança.

cep*	string
example: 72320000
CEP do pagador do boleto de cobrança.

uf*	string
example: DF
UF do pagador do boleto de cobrança.

email	string
example: pagador@dominio.com.br
E-mail do Pagador.

}
RateioCredito{
numeroBanco*	integer($int32)
example: 756
Número do Banco de Destino

numeroAgencia*	integer($int32)
example: 4027
Número da Agência de Destino

numeroContaCorrente*	integer($int32)
Número da Conta Corrente Destino.

contaPrincipal*	boolean
example: true
Identificador de conta principal.

codigoTipoValorRateio*	integer($int32)
example: 1
Tipo de valor do Rateio.

1 Percentual
valorRateio*	number($double)
example: 100
Valor do rateio.

codigoTipoCalculoRateio*	integer($int32)
example: 1
Tipo de cálculo do Rateio.

1 Valor Cobrado
numeroCpfCnpjTitular*	string
example: 98765432185
CPF ou CNPJ do titular da conta. Tamanho máximo 14

nomeTitular*	string
example: Marcelo dos Santos
Nome completo do titular da conta. Tamanho máximo 50

codigoFinalidadeTed*	integer($int32)
example: 10
Código da Finalidade TED.

1 Pagamento de Impostos, Tributos e Taxas
2 Pagamento à Concessionárias de Serviço Público
3 Pagamentos de Dividendos
4 Pagamento de Salários
5 Pagamento de Fornecedores
6 Pagamento de Honorários
7 Pagamento de Aluguéis e Taxas de Condomínio
8 Pagamento de Duplicatas e Títulos
9 Pagamento de Mensalidade Escolar
10 Crédito em Conta
...
99999 Outros
Para mais informações acesse https://www.bcb.gov.br/estabilidadefinanceira/comunicacaodados
codigoTipoContaDestinoTed*	string
example: CC
Tipo de conta Finalidade TED. Tamanho máximo 2

CC Conta Corrente
CD Conta de Depósito
CG Conta garantida
quantidadeDiasFloat*	integer($int32)
example: 1
Quantidade de dias float (não informar junto com dataFloatCredito)

dataFloatCredito	string($date)
example: 2020-12-30
Data do float (não informar junto com quantidadeDiasFloat)
Formato: yyyy-MM-dd

}
FaixaNossoNumero{
numeroCliente*	integer($int32)
example: 5224
Número do contrato

nome*	string
example: JOSE PEREIRA
Nome do cliente

codigoModalidade*	integer($int32)
example: 1
Número que identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
3 - CAUCIONADA
4 - VINCULADA
8 - COBRANÇA CONTA CAPITAL
numeroInicial*	integer($int32)
example: 1
Número do início da faixa

numeroFinal*	integer($int32)
example: 10
Número do final da faixa

quantidade*	integer($int32)
example: 10
Quantidade

numeroContratoCobranca	integer($int64)
example: 1
Indicar o id do contatroCobranca

validaDigitoVerificadorNossoNumero*	boolean
example: true
Indica que o contrato esta habilitado para validar o DV do NN.

}
BoletoAlteracao{
numeroCliente*	integer($int64)
example: 25546454
Número que identifica o contrato do beneficiário no Sisbr.

codigoModalidade*	integer($int32)
example: 1
Número que identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
3 - CAUCIONADA
4 - VINCULADA
5 - CARNÊ DE PAGAMENTOS
6 - INDEXADA
8 - COBRANÇA CONTA CAPITAL
numeroContratoCobranca	integer($int64)
example: 1
Indicar o id do contatroCobranca

especieDocumento	{
codigoEspecieDocumento*	[...]
}
seuNumero	{
seuNumero*	[...]
identificacaoBoletoEmpresa	[...]
}
desconto	{
tipoDesconto*	[...]
dataPrimeiroDesconto	[...]
valorPrimeiroDesconto	[...]
dataSegundoDesconto	[...]
valorSegundoDesconto	[...]
dataTerceiroDesconto	[...]
valorTerceiroDesconto	[...]
}
abatimento	{
valorAbatimento*	[...]
}
multa	{
tipoMulta*	[...]
dataMulta	[...]
valorMulta	[...]
}
jurosMora	{
tipoJurosMora*	[...]
dataJurosMora	[...]
valorJurosMora	[...]
}
rateioCredito	{
tipoOperacao*	[...]
rateioCreditos*	[...]
}
pix	{
utilizarPix*	[...]
}
prorrogacaoVencimento	{
dataVencimento*	[...]
}
prorrogacaoLimitePagamento	{
dataLimitePagamento*	[...]
}
valorNominal	{
valor*	[...]
}
}
BoletoBaixa{
numeroCliente*	integer($int32)
example: 5224
Número que identifica o contrato do beneficiário.

codigoModalidade*	integer($int32)
example: 1
Número que identifica a modalidade do boleto.

1 - SIMPLES COM REGISTRO
3 - CAUCIONADA
4 - VINCULADA
5 - CARNÊ DE PAGAMENTOS
6 - INDEXADA
8 - COBRANÇA CONTA CAPITAL
}
Status{
codigo	integer($int32)
example: 400
Método http aplicado à URL espeficida.

Enum:
Array [ 3 ]
mensagem	string
Mensagem de retorno.

}
MensagensErro{
mensagens*	[
Array com todas as mensagem de erro encontradas.

SicoobMensagem{...}]
}
SicoobMensagem{
mensagem*	string
Mensagem de retorno que pode ser informativa ou de erro

codigo*	string
Código padrão de erro

}