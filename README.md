# Coral Books

## Visão Geral do Projeto

**Coral Books** é uma plataforma digital desenvolvida para conectar livrarias, bibliotecas e leitores, facilitando a busca, localização e consulta da disponibilidade de livros.

O principal diferencial do sistema é permitir que os estabelecimentos informem a localização exata de cada livro dentro do espaço físico, tornando a experiência de busca mais rápida e eficiente para os leitores.

Além disso, cada livraria ou biblioteca possui um perfil próprio, semelhante a uma rede social, onde pode divulgar informações sobre seu estabelecimento e seu acervo.

O projeto terá também uma aba de avaliação de livros estilo letterbox para leitores darem sua opnião.

---

# Objetivo

Criar uma plataforma que facilite o encontro entre leitores e estabelecimentos que possuem livros disponíveis para venda ou empréstimo, oferecendo informações detalhadas sobre disponibilidade, estoque e localização física dos exemplares.

---

# Público-Alvo

## Leitores

Usuários que desejam encontrar livros específicos com facilidade, verificando sua disponibilidade e localização em livrarias e bibliotecas.

## Donos de Livrarias e Bibliotecas

Responsáveis por estabelecimentos que desejam divulgar seus acervos, gerenciar estoques e facilitar o acesso dos leitores aos livros disponíveis.

---

# Identidade Visual

## Paleta de Cores

| Cor | Utilização | Código |
|------|------------|---------|
| Branco Marfim | Cor principal (60%) | `#F4F3EF` |
| Vermelho Coral | Cor Secundária (30%) | `#FF4040` |
| Preto Carvão | Cor apoio (10%) | `#1A1A1A` |



## Tipografia

**Fonte Principal:** Arial

---

# Conceito da Marca

A identidade visual é inspirada na espécie *Micrurus corallinus* (cobra-coral verdadeira).

### Proposta da Logo

Uma cobra-coral envolvendo um livro aberto, inspirada no conceito visual da marca Firefox.

A composição busca transmitir:

- Conhecimento
- Organização
- Acessibilidade
- Facilidade na localização de livros

### Logo

<p align="center">
  <img src="./Logo/Logo.png" alt="Coral Books Logo" width="250">
</p>


---

# Dados do Projeto

| Informação | Valor |
|------------|--------|
| Nome | Coral Books |
| Telefone | (19) 99576-9393 |
| E-mail | micrurus.corallinustrue@gmail.com |
| Instagram | @TrueCoralBooks |

---

# Estrutura do Site

## Home

Página inicial contendo:

- Barra de pesquisa centralizada;
- Destaque para livros disponíveis;
- Vitrine de livrarias e bibliotecas cadastradas;
- Sugestão de estabelecimentos próximos.

---

## Cadastro

O sistema possui dois tipos de cadastro.

### Cadastro de Leitor

**Campos:**

- Nome
- E-mail
- Senha

### Cadastro de Livraria ou Biblioteca

**Campos:**

- Nome do responsável
- Nome do estabelecimento
- Endereço
- Telefone
- E-mail
- Senha

---

## Login

Página destinada ao acesso de usuários previamente cadastrados.

---

## Perfil do Estabelecimento

Funciona como uma página pública de apresentação da livraria ou biblioteca.

**Informações exibidas:**

- Nome do estabelecimento
- Endereço
- Fotografias
- Horário de funcionamento
- Telefone
- Descrição institucional

O perfil pode ser visualizado por qualquer visitante da plataforma.

---

## Acervo

Página responsável pela exibição dos livros cadastrados pelo estabelecimento.

**Informações exibidas para cada livro:**

- Título
- Autor
- Capa
- Disponibilidade
- Quantidade em estoque
- Localização física dentro do estabelecimento

---

## Cadastro de Livro

Área exclusiva para proprietários cadastrarem obras em seus acervos.

### Informações do Livro

- Título
- Autor
- Gênero
- ISBN
- Capa
- Descrição
- Preço (quando disponível para venda)
- Quantidade em estoque

### Status

- À venda
- Em empréstimo
- Indisponível

### Localização Física

- Corredor
- Prateleira
- Seção

---

## Busca de Livros

Página pública destinada à pesquisa de livros.

### Filtros Disponíveis

- Título
- Autor
- Gênero
- Cidade

### Resultado da Busca

O sistema exibirá:

- Livros encontrados
- Estabelecimentos onde estão disponíveis
- Quantidade disponível
- Localização exata dentro do estabelecimento

---

## Comunidade Literária

Página dedicada à interação entre leitores, inspirada em plataformas de avaliação e compartilhamento de experiências literárias.

Nesta área, os usuários podem registrar suas leituras, avaliar livros e publicar resenhas, criando uma comunidade voltada à troca de opiniões e recomendações.

### Funcionalidades

- Avaliação de livros por estrelas (1 a 5);
- Publicação de resenhas e opiniões;
- Comentários em avaliações de outros leitores;
- Histórico de livros avaliados;
- Lista de livros favoritos;
- Registro de livros:
  - Lidos;
  - Em leitura;
  - Desejados.
- Perfil público do leitor com suas atividades e avaliações.

## Sobre

Página destinada à apresentação da proposta da plataforma.

### Conteúdo

- Funcionamento para leitores
- Funcionamento para livrarias e bibliotecas
- Benefícios oferecidos pelo sistema
- Diferencial de localização física dos livros

O principal destaque é a capacidade de indicar exatamente em qual corredor, prateleira ou seção o livro pode ser encontrado.

---

## Contato

Página destinada ao suporte dos usuários.

### Recursos Disponíveis

- Formulário de contato
- Perguntas frequentes (FAQ)
- Informações de suporte

---

# Navegação

O menu permanece fixo no topo da página para facilitar a navegação durante toda a utilização da plataforma.

## Visitantes e Leitores

- Home
- Buscar Livros
- Sobre
- Contato
- Cadastro / Login

## Donos de Livrarias e Bibliotecas

- Minha Livraria
- Meu Acervo
- Cadastrar Livro
- Editar Perfil
- Sair

---

# Desenvolvimento Mobile First

O projeto será desenvolvido seguindo a abordagem **Mobile First**, garantindo uma experiência otimizada para dispositivos móveis antes da adaptação para telas maiores.

## Conceitos Aplicados

### Layout Responsivo

Adaptação automática do conteúdo para diferentes resoluções e tamanhos de tela.

### Menu Compacto

Utilização do menu no formato "hambúrguer" para melhor aproveitamento do espaço em dispositivos móveis.

### Usabilidade em Dispositivos Móveis

Botões maiores e áreas de interação adequadas ao toque.

### Media Queries

Estrutura CSS desenvolvida inicialmente para smartphones, com expansões para tablets e desktops.

### Legibilidade

- Fontes adequadas para leitura;
- Espaçamento consistente entre elementos;
- Hierarquia visual clara.

---

# Diferencial Competitivo

Enquanto a maioria das plataformas informa apenas onde um livro está disponível, o Coral Books permite que o usuário saiba exatamente onde encontrá-lo dentro do estabelecimento.

## Exemplo

**Livro:** *Harry Potter e a Pedra Filosofal*

**Estabelecimento:** Biblioteca Central

**Localização:** Corredor 3 → Estante B → Prateleira 2

Essa funcionalidade reduz o tempo de procura, melhora a organização dos acervos e proporciona uma experiência mais eficiente tanto para leitores quanto para os responsáveis pelos estabelecimentos.
