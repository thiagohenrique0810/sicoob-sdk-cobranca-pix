API de Cobrança Bancária V3
Visão Geral

Para aprimorar nossos serviços, atualizamos a API de Cobrança Bancária para a versão 3. As principais diferenças entre as versões 2 e 3 podem ser consultadas em: Novidades e Atualizações. Recomendamos que os cooperados criem novos aplicativos para utilizar a versão atualizada.

Esta API disponibiliza serviços para recebimento de valores referentes às vendas de produtos e serviços da sua empresa, por meio de boletos de cobrança, pagos em toda a rede bancária. Possui funcionalidades que auxiliam na gestão da carteira registrada, tornando viável todo o processo de acompanhamento, desde a inclusão de novos boletos, alteração de informações relevantes, protesto/negativação de títulos vencidos e não pagos, até a liquidação ou baixa do título.

Funcionalidades

Gerenciamento de Boletos
Alteração de informações de pagadores de boletos
Negativação de pagadores
Protesto de boletos
Movimentação
Especificação da API

Acesse a documentação técnica com todas as informações, clicando aqui.

Confira abaixo um vídeo tutorial de como você pode configurar as requisições no Postman. Você também pode fazer o download da nossa coleção da API de Cobrança Bancária V3 para o Postman.



 Faça download da coleção API Cobrança Bancária V3 para o Postman

Informações Importantes
Webhook

Sempre que o Sicoob recebe a confirmação da baixa operacional de um boleto, o sistema integrado envia automaticamente uma notificação para uma URL configurada, eliminando a necessidade de consultas frequentes para verificar a situação da movimentação de um boleto.

POST /Cadastrar Webhook

Realiza o cadastro de uma URL para receber as notificações automáticas das movimentações. Para isso, é necessário informar o código do movimento, o código do período do movimento e o e-mail. Um idWebhook é gerado para consulta do webhook cadastrado.

Além da mensagem de notificação pagamento (baixa operacional), o sistema também envia uma notificação de validação da URL do webhook sempre que ocorre:

O cadastro de um novo webhook

A alteração da URL do webhook

A reativação de um webhook

Exemplo JSON da notificação de validação da URL do webhook:

{ "idWebhook": 990,
"validacaoWebhook": true }

url
Deve ser https.

codigoTipoMovimento 7 – Pagamento (baixa operacional)

codigoPeriodoMovimento 1 – Movimento Atual (D0)

idWebhook Identificador único do webhook.

validacaoWebhook Indica se a notificação é uma validação da URL do webhook

GET /Consultar Webhooks Cadastrados

Consulta realizada a partir do idWebhook e codigoTipoMovimento, mostrando informações detalhadas sobre o webhook cadastrado.

GET /Consultar Solicitações de um Webhook

Consulta as solicitações de notificação para um webhook com base na data da solicitação informada.

É necessário informar a dataSolicitacao, pagina e o codigoSolicitacaoSituacao.

codigoSolicitacaoSituacao

3 – Enviado com sucesso
6 – Erro no envio

Observação:
A baixa operacional não se refere à liquidação final, mas sim do registro da intenção de pagamento realizada.

Como o Sicoob avalia os critérios para garantir a aprovação do webhook

Durante o cadastro da URL de webhook para recebimento das notificações da API de Cobrança Bancária via Open Banking, o sistema realiza uma validação automatizada da URL fornecida.

Importante:
Em todas as verificações, tanto no cadastro quanto no envio das notificações, a URL só será aceita se o servidor responder com um dos seguintes códigos de status HTTP:

200 OK
201 Created
204 No Content
Respostas com outros códigos, como 202 Accepted ou 302 Found (redirecionamento), resultam em
falha na validação
do webhook.

Recomendação:
Certifique-se de que a URL cadastrada responda diretamente com um status HTTP 200, 201 ou 204 no momento da validação inicial.
Evite redirecionamentos ou respostas assíncronas para garantir o sucesso no cadastro do webhook.

Exemplo de webhook recebido:

{
"idWebhook": 214,
"tipoMovimento": 7,
"dados": {
"numeroIdentificadorBaixa": "2024102000741150823",
"codigoBarrasBoleto": "75692868200000405001434201006355000002443003",
"codigoBarrasBaixa": "75692868200000405001434201006355000002443003",
"nossoNumero": "0000002443",
"seuNumero": "00-03",
"codigoBancoRecebedor": "756",
"codigoAgenciaRecebedora": 3069,
"numeroCliente": 63550,
"cpfCnpjBeneficiario": "00500754977",
"codigoTipoPessoaPagador": "F",
"nomePagador": "Amanda",
"cpfCnpjPagador": "09992004959",
"nomeFantasiaPagador": "Amanda",
"codigoTipoPessoaPortador": "F",
"nomePortador": "João",
"cpfCnpjPortador": "09197004979",
"valorBoleto": 405,
"valorPagamento": 407.41,
"codigoCanalPagamento": 3,
"codigoMotivoCancelamento": 2,
"dataEmissao": "2021-04-19",
"dataVencimento": "2021-07-15",
"dataLimitePagamento": "2022-01-10",
"dataHoraSituacaoBaixa": "2021-07-22T13:45:33.000Z",
"baixaRealizadaEmContigencia": false,
"cancelamentoBaixa": false }
}

Atenção nas datas e horários:

Todos os campos de data e hora retornados pela API seguem o padrão UTC (Tempo Universal Coordenado), indicado pela letra "Z" ao final do valor (exemplo: 2025-06-06T00:15:00Z).

Caso o seu sistema utilize o horário oficial de Brasília (UTC-3) ou outro fuso horário, é necessário realizar a conversão de fuso horário ao processar essas informações, para que as datas refletidas nas análises e conciliações estejam de acordo com o horário local.

Movimentações

A funcionalidade de movimentações permite que o beneficiário acompanhe os eventos ocorridos na carteira de cobrança registrada, como liquidações, baixas, alterações e demais ocorrências relacionadas aos boletos emitidos.

Por meio dessa funcionalidade, é possível solicitar a geração dos arquivos de movimentação (JSON) para um determinado período, acompanhar o status da solicitação e, ao final, realizar o download do(s) arquivo(s) gerado(s). Esses arquivos contêm os registros consolidados das movimentações da carteira e são fundamentais para conciliação e controle financeiro.

Importante:

As consultas estão limitadas a qualquer período de 2 dias dentro de 1 ano corrido até a data da solicitação.
Após a solicitação da movimentação, os arquivos gerados ficam disponíveis por 30 dias para download.
Rate Limit API Cobrança Bancária:

Endpoints de Movimentações (Solicitar, Consultar e Download).
10 por segundo

Endpoints GET Consultar boleto, Listar Boletos por Pagador, Emissão segunda via de boleto e Consulta de dados de faixas de nosso número disponíveis.
10 por segundo

Endpoint de Incluir Boletos.
2 por segundo

Demais endpoints.
20 por segundo

Propriedades Opcionais

A API Cobrança Bancária V3 não permite o envio de requisições com propriedades opcionais com valores vazios ou nulos, caso o integrador opte por não utilizar alguma propriedade que seja opcional, a propriedade deve ser ignorada no envio das requisições, caso contrario, a API poderá devolver um erro negocial (erros http da ordem 400).

Atenção para o Campo "numeroContratoCobranca"

O campo "numeroContratoCobranca" não é necessário no corpo da requisição para o cadastro de um boleto.

Observação:
Caso este campo seja preenchido incorretamente, a API retornará o erro:
"Número do contrato de cobrança inválido".
Este campo representa o número do contrato secundário de cobrança do cooperado com a cooperativa. Ele corresponde ao código do cliente no portal de atendimentos da cooperativa. No entanto, seu uso não é necessário para a realizar a integração. O campo só deve ser preenchido em casos muito específicos, quando houver uma orientação expressa para utilizá-lo.

Lista de escopos da API Cobrança Bancária V3

boletos_inclusao

boletos_consulta

boletos_alteracao

webhooks_alteracao

webhooks_consulta

webhooks_inclusao

Lista de escopos da API Cobrança Bancária V2

cobranca_boletos_consultar cobranca_boletos_incluir cobranca_boletos_pagador cobranca_boletos_segunda_via cobranca_boletos_descontos cobranca_boletos_abatimentos cobranca_boletos_valor_nominal cobranca_boletos_seu_numero cobranca_boletos_especie_documento cobranca_boletos_baixa cobranca_boletos_rateio_credito cobranca_pagadores cobranca_boletos_negativacoes_incluir cobranca_boletos_negativacoes_alterar cobranca_boletos_negativacoes_baixar cobranca_boletos_protestos_incluir cobranca_boletos_protestos_alterar cobranca_boletos_protestos_desistir cobranca_boletos_solicitacao_movimentacao_incluir cobranca_boletos_solicitacao_movimentacao_consultar cobranca_boletos_solicitacao_movimentacao_download cobranca_boletos_prorrogacoes_data_vencimento cobranca_boletos_prorrogacoes_data_limite_pagamento cobranca_boletos_encargos_multas cobranca_boletos_encargos_juros_mora cobranca_boletos_pix