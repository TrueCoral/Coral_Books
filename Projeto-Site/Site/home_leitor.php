<?php
session_start();

if (!isset($_SESSION["tipo"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Coral Books - Leitor</title>

  
    <link rel="stylesheet" href="assets/css/home_leitor.css">

</head>


<body>

    <header>

        <div class="logo">

            <!-- MUDAR DEPOIS:
                 Colocar aqui o caminho da logo definitiva
                 do Coral Books. -->
            <img
                src="assets/logo/Logocoral.png"
                alt="Coral Books"
            >

        </div>

        <nav>

            <!-- MUDAR DEPOIS:
                 Trocar "#" pelos caminhos reais das páginas. -->

            <a href="#">
                Início
            </a>

            <a href="#">
                Livros
            </a>

            <a href="#">
                Livrarias
            </a>

            <a href="#">
                Perfil
            </a>

        </nav>

    </header>



    <!-- =========================================
         CONTEÚDO PRINCIPAL
    ========================================== -->

    <main>


        <!-- =====================================
             BOAS-VINDAS
        ====================================== -->

        <section class="boas-vindas">

            <!-- MUDAR DEPOIS:
                 O nome deverá vir do usuário logado
                 através da sessão/PHP. -->

            <h1>
                Olá, Leitor! 👋
            </h1>

            <p>
                Encontre seu próximo livro no Coral Books.
            </p>

        </section>



        <!-- =====================================
             PESQUISA
        ====================================== -->

        <section class="pesquisa">

            <!-- MUDAR DEPOIS:
                 Esse campo deverá pesquisar no banco
                 pelo título, autor ou ISBN. -->

            <input
                type="text"
                placeholder="Pesquise por livro, autor ou ISBN..."
            >


            <!-- MUDAR DEPOIS:
                 Criar a lógica PHP/JavaScript para
                 realizar a pesquisa. -->

            <button>
                Pesquisar
            </button>

        </section>



        <!-- =====================================
             FILTRO
        ====================================== -->

        <section class="filtro">

            <label for="tipo">
                Tipo de estabelecimento
            </label>


            <select id="tipo">

                <!-- MUDAR DEPOIS:
                     Essas opções poderão ser utilizadas
                     para filtrar os resultados do banco. -->

                <option value="todos">
                    Todos
                </option>

                <option value="biblioteca">
                    Bibliotecas
                </option>

                <option value="livraria">
                    Livrarias
                </option>

            </select>

        </section>



        <!-- =====================================
             LISTA DE LIVROS
        ====================================== -->

        <section class="livros">

            <h2>
                Livros disponíveis
            </h2>


            <div class="lista-livros">


                <!-- =================================
                     LIVRO 1
                ================================== -->

                <!-- MUDAR DEPOIS:
                     Esses cards são apenas exemplos.
                     Quando o banco estiver pronto,
                     eles deverão ser gerados automaticamente
                     através de um SELECT no banco. -->

                <div class="livro">


                    <!-- MUDAR DEPOIS:
                         A imagem deverá vir do banco
                         ou de uma pasta de capas. -->

                    <img
                        src="../imagens/livro1.jpg"
                        alt="Capa do livro"
                    >


                    <!-- MUDAR DEPOIS:
                         Substituir pelo título vindo do banco. -->

                    <h3>
                        Dom Casmurro
                    </h3>


                    <!-- MUDAR DEPOIS:
                         Substituir pelo autor vindo do banco. -->

                    <p>
                        Machado de Assis
                    </p>


                    <!-- MUDAR DEPOIS:
                         A disponibilidade deverá ser
                         calculada usando a quantidade
                         cadastrada no banco. -->

                    <span class="disponivel">
                        Disponível
                    </span>

                </div>



                <!-- =================================
                     LIVRO 2
                ================================== -->

                <div class="livro">

                    <img
                        src="../imagens/livro2.jpg"
                        alt="Capa do livro"
                    >

                    <h3>
                        O Pequeno Príncipe
                    </h3>

                    <p>
                        Antoine de Saint-Exupéry
                    </p>

                    <span class="disponivel">
                        Disponível
                    </span>

                </div>



                <!-- =================================
                     LIVRO 3
                ================================== -->

                <div class="livro">

                    <img
                        src="../imagens/livro3.jpg"
                        alt="Capa do livro"
                    >

                    <h3>
                        1984
                    </h3>

                    <p>
                        George Orwell
                    </p>

                    <span class="disponivel">
                        Disponível
                    </span>

                </div>



                <!-- =================================
                     LIVRO 4
                ================================== -->

                <div class="livro">

                    <img
                        src="../imagens/livro4.jpg"
                        alt="Capa do livro"
                    >

                    <h3>
                        Harry Potter
                    </h3>

                    <p>
                        J. K. Rowling
                    </p>

                    <span class="disponivel">
                        Disponível
                    </span>

                </div>


            </div>

        </section>

    </main>



    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer>

        <!-- MUDAR DEPOIS:
             Colocar informações definitivas do
             Coral Books, como contato, redes sociais,
             direitos autorais etc. -->

        <p>
            © 2026 Coral Books
        </p>

    </footer>


</body>

</html>