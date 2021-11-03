```markdown
Exercícios propostos:
  [F.24BooleModelos-ex] - 2, 3, 5, 7
  [F.28BooleProva-ex.] - 1, 2, 4, 5, 8, 10, 12 
```

## **Exercicio 2 F.24**

## **Exercicio 3 F.24**
> ![](Ex3_tp2_F24.PNG)

## **Exercicio 5 F.24**

1. Small(a) ∨ Large(c) ∨ Large(d)
2. BackOf(d,b) ∧ BackOf(e,b)
3. BackOf(d,b) ∧ BackOf(e,b) ∧ ¬Small(d) ∧ ¬Small(e)
4. Cube(d) ∧ Cube(c) ∧ ¬Small(d) ∧ ¬Small(c)
5. ¬RightOf(e,c) ∧ ¬RightOf(a,c) ∧ ¬LeftOf(e,b) ∧ ¬LeftOf(a,b)
5.  ¬(RightOf(e,c) ∧ RightOf(a,c) ) ∧ ¬(LeftOf(e,b) ∧ LeftOf(a,b) )
6. ¬Large(e) ∨ BackOf(e,a)
7. ¬(Between(c,a,b)) ∧ ¬(FrontOf(c,a) ∧ FrontOf(c,b) )
8. ( Tet(a) ∧ Tet(b) ) ∨ ( Tet(a) ∧ Tet(f) ) || Tet(a) ∧ ( Tet(b) ∨ Tet(f) )
9. ¬( FrontOf(d,c) ∨ FrontOf(d,b) ) ∧ ¬( FrontOf(c,c) ∨ FrontOf(c,b) )
10. Between(c,d,f) ∨ ( Smaller(c,d) ∧ Smaller(c,f) )
11. ¬SameRow(b,c)
12. SameCol(b,e) ∧ SameRow(e,d) ∧ SameCol(d,a)

> ![](Ex5_tp2_F24.PNG)


## **Exercicio 7 F24**

### Transform into DNF (A ∧ B)  ∨ (A ∧ B)
1. (Cube(a)  ∧ LeftOf(a,b) )  ∨ (Cube(a)  ∧ BackOf(a,b) )
2. ( Larger(a,b)  ∧ Cube(a) )  ∨ ( Larger(a,b)  ∧ Tet(a) ) ∨ ( Larger(a,b)  ∨ a=b ) 
3. ( Dodec(c)  ∧ Between(a,b,c) )  ∨ ( Dodec(c)  ∧ Tet(a) )  ∨ ( Dodec(c)  ∧ ¬Tet(b))
4. ¬Cube(a)  ∨ ¬Cube(b)  ∨ (Small(a)  ∧ Small(b) )
5. (Small(a)   ∧  Cube(a) )  ∨ (Medium(a)  ∧ Cube(a))  ∨ ( Small(a)  ∧ ¬Dodec(a) )  ∨ ( Medium(a) ∧ ¬Dodec(a))

## **Exercicio 1 F28**

![](Ex1_tp2_F28.PNG)