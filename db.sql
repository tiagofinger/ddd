CREATE TABLE students (
    cpf TEXT PRIMARY KEY,
    name TEXT,
    email TEXT
);
CREATE TABLE phones (
    ddd TEXT,
    number TEXT,
    cpf_student TEXT,
    PRIMARY KEY (ddd, number),
    FOREIGN KEY(cpf_student) REFERENCES students(cpf)
);
