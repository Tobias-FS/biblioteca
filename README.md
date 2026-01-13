# Biblioteca

Uma API RESTful para o controle de catálogos de livros de uma biblioteca.  
Este é um projeto de estudos focado no aprendizado dos fundamentos de back-end, Programação Orientada a Objetos (POO), manipulação de dados com PDO, protocolo HTTP e boas práticas de desenvolvimento.


## Tecnologias

- **Linguagem:** PHP 7+ (Puro, sem frameworks)
- **Banco de Dados:** MySQL
- **Arquitetura:** MVC (Model-View-Controller)
- **Gerenciamento de Dependências:** Composer (Autoload PSR-4)
- **Padronização:** Respostas JSON e Status Codes HTTP

## Como Executar o Projeto

1. **Clonar o repositório:**
   ```bash
   git clone https://github.com/Tobias-FS/biblioteca.git
   ```
2. **Configurar o banco de dados:**  
Importe o arquivo `estrutura.sql` localizado na pasta `/src/bd`. Ele contém o esquema da tabela `livros` com todos os campos necessários.
3. **Instalar dependências e gerar o Autoload**  
    ```bash
    composer install
    ```
4. **Iniciar o servidor de desenvolvimento**:  
    ```bash
    composer dev
    ```

## End-points

- `GET /livros` – Listar todos os livros
- `GET /livros/{id}` – Ver detalhes de um livro
- `POST /livros` – Adicionar novo livro
- `PUT /livros/{id}` – Editar um livro existente
- `DELETE /livros/{id}` – Remover um livro

## Aprendizados Implementados
Este projeto serviu para consolidar conhecimentos fundamentais de backend:

- **Manipulação de Cabeçalhos**: Uso de `header('Content-Type: application/json')`.
- **Verbos HTTP**.
- **Tratamento de Erros**.
- **Persistência de Dados**: CRUD completo utilizando a classe `PDO`.