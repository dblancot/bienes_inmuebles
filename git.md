# GIT VERSION
## {ver version de git instalada}
    git --version 

# GIT CONFIG
## {configurar el nombre de la rama principal}
    git config --global init.defaultBranch main
## {usuario}
    git config --global  user.name "Diego Blanco"
## {email}
    git config --global  user.email "diegoblancotaboas@gmail.com"
## {ver configuracion global y edición manual}
    git config --global  -e

# TERMINAL
## {salir, pulsar ESC antes}
    :q
## {salir, tras pulsar "a" para modificar y "ESC" una vez modificado}
    :wq!

# GIT INICIALIALIZACIÓN
##  {inicializar el repositorio}
    git init

# GIT STATUS
    git status
## {alias}
    git s
## {creación del alias}
    git config --global alias.s "status --short"

# GIT LOG
    git log 
# {alias}
    git lg
## {creación del alias}
    git config --global alias.lg "log --graph --abbrev-commit --decorate --format=format:'%C(bold blue)%h%C(reset) - %C(bold green)(%ar)%C(reset) %C(white)%s%C(reset) %C(dim white)- %an%C(reset)%C(bold yellow)%d%C(reset)' --all"
## {reflog}
    git reflog

# GIT ADD / RESET
## {añadir el archvio al escenario}
    git add [nombre archivo]
## {eliminar archivo del escenario}
    git reset [nombre archivo]
## {añadir todos los archivos trackeados al escenario}
    git add .

# GIT COMMIT
## {commit de los archivos en el escenario}
    git commit -m "[nombreCommit]"
## {añade los archivos trackeados al escenario y los commitea}
    git commit -am "[nombreCommit]"
## {modificar commit manualmente}
    git commit --amend
## restaurar al último commit
    git checkout -- .

# GIT RESET
## {volver a un commit antiguo sin deshacer lo hecho
    git reset --soft [idcommit]
    git reset --mixed [idcommit]
## {destructivo}
    git reset --hard [idcommit]

# BRANCH / RAMAS
## {ver en que rama estoy}
    git branch
## {crear rama}
    git branch [nombreRama]
## {cambiar nombre de la rama master a main}
    git branch -m master main
## {eliminar rama ("-f" al final para forzar el borrado)}
    git branch -d [nombreRama]
    git branch -d [nombreRama] -f
## {moverse a otra rama}
    git checkout [nombreRama]
## {crear rama y moverse a ella}
    git checkout -b [nombreRama]
## {unir rama estando situado en la master}
    git merge [nombreRama]

# GIT TAG
## {crear tag en el commit actual}
    git tag [nombreTag]
## {crear tag en cualquier commit}
    git tag -a [nombreTag] [hashCommit] -m "[mensageTag]"
## {borrar tag}
    git tag -d [nombreTag]
## {ver tags}
    git tag

# EDITAR ARCHIVOS
    git mv nombre1 nombre2 (mv es mover, pero como es el mismo directorio es como renombrar)
    git rm archivo1 (borra el archivo)