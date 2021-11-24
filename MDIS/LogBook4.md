# **Week #5 Class Exercises**

> [F42quant-ex]
Exercícios propostos:
  3 - (da 3.8 à 3.15)
  4 - (da 4.6 à 4.15)
  5, 6
  8 - (da a) até à e) e pôr a e) em Prenex)
  10, 11, 12


### **Exercise 3 [3.8; 3.15]**

8. ∀x( Cube(x) ∧ Large(x))   →  ∀x( LeftOf(b,x) )
9. ∃x( LeftOf(x,b) ∧ BackOf(x,c) )
10. ∃x( Cube(x) ∧ Large(x)  ∧ LeftOf(x,b)  ∧ BackOf(x,c) )
11. ∃ x(Cube(x)  ∧ Large(x)  ∧ LeftOf(x,b)  ∧ BackOf(x,c))
12. ∃x( Dodec(x) ∧  ¬Large(x))
13. ∃x( ¬(Dodec(x)  ∧ Large(x)))
14. ¬∃x( Dodec(x) ∧ Large(x) )
15. ∀x( ¬(LeftOf(b,x)  ∧ Cube(x)))

![](ex3_tp5_mdis.PNG)

### **Exercise 4 [4.6; 4.15]**

6. ∀x( Cube(x)   →  (LeftOf(x,b)  ∧ RightOf(x,a)) )
7. ∀x( Between(x,a,b)  →  Cube(x) )
8. ∀x( Dodec(x)  →  ( Medium(x)  ∨ Large(x)) )
9. ¬∀x( Dodec(x) →  Small(x) )
10. ¬∀x( Adjoins(a,x) )
11. ∃x( ¬Adjoins (a,x) )
12. ∀x ¬( Adjoins(a,x) );
13. ∀x ¬(Cube(x)  ∧ RightOf(a,x))
14. ∀x( Cube(x) → ¬(SameRow(x,a)  ∨ SameRow(x,b) ))
15. ∀x( Cube(x)  ↔  ¬(SameRow(x,a)  ∨ SameRow(x,b) ))

![](ex4_tp5_mdis.PNG)

### **Exercise 5**

> ¬∃x( P(x) ∧ Q(x) )
> ∀x ¬ (P(x) ∧ Q(x))
> ∀x (  ¬P(x) ∨ ¬Q(x) )
> ∀x (  P(x) → ¬Q(x) )

### **Exercise 6**

> 6.1 && 6.5 equivalent
> ¬∀x (Cube(x) → Small(x))
> ∃x ¬(Cube(x) → Small(x))
> ∃x ¬( ¬Cube(x) ∨ Small(x))
> ∃x ¬( Cube(x) ∧ ¬Small(x))
> ∃x (¬Small(x) ∧ Cube(x))
<br>

> 6.2 && 6.4 equivalent
> ¬∃x (Cube(x) ∧ Large(x))
> ∀x ¬(Cube(x) ∧ Large(x))
> ∀x (¬Large(x) ∨ ¬Cube(x))
<br>

> 6.3 && 6.6 equivalent
> ¬∀x (Large(x) ↔ Dodec(x))
> ∃x ¬ (Large(x) ↔ Dodec(x))
> ∃x ¬ ( (¬Large(x) ∨ Dodec(x)) ∧ (Large(x) ∨ ¬Dodec(x)) )
> ∃x ( ¬(¬Large(x) ∨ Dodec(x)) ∨ ¬(Large(x) ∨ ¬Dodec(x)) )
> ∃x ((Large(x) ∧ ¬Dodec(x)) ∨ (Dodec(x) ∧ ¬Large(x)))
<br>

### **Exercise 8**

1.  ∀x∀y( (Tet(x)  ∧  Dodec(y) )→  FrontOf(x,y) )


