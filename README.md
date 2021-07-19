# Библиотека для создания консольных команд
Библиотека обеспечивает обработку ввода-вывода (I/O) при
работе в консоли с возможностью реализации собственных команд конечным
разработчиком, который использует эту библиотеку.
Обработка входящих аргументов запуска реализована в соответствии со
следующим соглашением:
- название команды передается первым аргументом в произвольном формате;
- аргументы запуска передаются в фигурных скобках через запятую в следующем
формате:
  - одиночный аргумент: {arg}
  - несколько аргументов: {arg1,arg2,arg3} ИЛИ {arg1} {arg2} {arg3}
ИЛИ {arg1,arg2} {arg3}
- параметры запуска передаются в квадратных скобках в следующем формате:
  - параметр с одним значением: [name=value]
  - параметр с несколькими значениями: [name={value1,value2,value3}]

# Функциональность библиотеки включает в себя:
- регистрацию необходимых команд в приложении;
- возможность установить название и описание каждой команды;
- обработку ввода пользователя (парсинг аргументов и выявление имени команды,
аргументов и параметров);
- выполнение заданной логики с возможностью вывода в информации в консоль.
При запуске приложения без указания конкретной команды необходимо выводить список
всех зарегистрированных в нём команд и их описания.
При запуске любой из команд с аргументом {help} необходимо выводить описание
команды.

Ограничения: библиотека проверена для работы на ОС семейства Linux.

# Приложение на базе разработанной библиотеки
На базе разработанной библиотеки создано простое консольное приложение.

Особенности приложения:
- единая точка входа для запуска из консоли ОС семейства Linux;
- возможность регистрации неограниченного количества команд в приложении.
В приложении создана и зарегистрирована консольная команда, которая на
вход принимает неограниченное количество аргументов и параметров и выводит их на экран
в читаемом для пользователя виде.

