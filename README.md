# OdontoSys - Sistema de Gestão de Consultório Odontológico

Este é um sistema web desenvolvido como projeto para as disciplinas de Desenvolvimento Web II e Engenharia de Software. O objetivo é fornecer uma solução completa para a gestão de pacientes, agendamentos, orçamentos, estoque e finanças de um consultório odontológico.

## Pré-requisitos

Para executar este projeto em sua máquina local, você precisará de um ambiente de desenvolvimento web. A maneira mais fácil é usar um pacote "tudo-em-um" como o **Laragon** (para Windows) ou o **XAMPP** (Windows, macOS, Linux).

Certifique-se de que seu ambiente tenha:
- PHP (versão 8.2 ou superior)
- MySQL ou MariaDB
- Composer ([instruções de instalação](https://getcomposer.org/download/))
- Node.js e NPM ([instruções de instalação](https://nodejs.org/))
- Git ([instruções de instalação](https://git-scm.com/downloads))

## Passos para Instalação

Siga este guia no seu terminal para configurar e executar o projeto.

**1. Clone o Repositório**
```bash
git clone https://github.com/mtdsza/TrabEngSoftI.git
```

**2. Acesse a Pasta do Projeto**
```bash
cd TrabalhoDWEB2
```

**3. Instale as Dependências do PHP**
Este comando irá instalar o Laravel e todas as bibliotecas do backend.
```bash
composer install
```

**4. Crie o Arquivo de Configuração de Ambiente**
Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.
*Se estiver usando o **CMD** do Windows:*
```bash
copy .env.example .env
```
*Se estiver usando **Linux, macOS ou Git Bash** no Windows:*
```bash
cp .env.example .env
```

**5. Gere a Chave da Aplicação**
Toda aplicação Laravel precisa de uma chave de segurança única.
```bash
php artisan key:generate
```

**6. Configure o Banco de Dados**
a. Usando uma ferramenta como o phpMyAdmin, MySQL Workbench ou DBeaver, crie um novo banco de dados vazio (ex: `odontosys`).

b. Abra o arquivo `.env` que você acabou de criar e edite as seguintes linhas com os dados do seu banco de dados local (certifique-se de que as linhas NÃO estão comentadas):
```ini
DB_CONNECTION=mysql    # <--- Certifique-se de que está usando o MySQL
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=odontosys  # <--- Coloque o nome do banco que você criou
DB_USERNAME=root       # <--- Seu usuário do MySQL (geralmente 'root')
DB_PASSWORD=           # <--- Sua senha do MySQL (pode ser vazia)
```

**7. Crie as Tabelas e o Usuário Admin**
Este comando irá construir toda a estrutura do banco de dados e criar um usuário administrador padrão para o primeiro acesso.
```bash
php artisan migrate:fresh --seed
```

**8. Instale e Compile os Arquivos de Front-end**
Estes comandos preparam os arquivos CSS e JavaScript do sistema.
```bash
npm install
npm run build
```

**9. Inicie o Servidor**
```bash
php artisan serve
```

O sistema estará rodando! Acesse a URL: **[http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)**

## Acesso ao Sistema

Para o primeiro acesso, utilize as credenciais de administrador criadas no passo 7:

- **Login:** `admin`
- **Senha:** `adminodonto`

Após o login, o administrador pode criar novas contas de usuário (Secretaria, Profissional) através da seção "Usuários" na barra lateral.

## Tecnologias Utilizadas
- **Backend:** Laravel 12, PHP 8.2
- **Frontend:** Blade, Bootstrap 5, JavaScript, IMask.js
- **Banco de Dados:** MySQL / MariaDB
