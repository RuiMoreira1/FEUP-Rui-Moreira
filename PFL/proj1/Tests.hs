{-} One strategy would be giving the function the big number list already reversed
and using head and tail, but he have the init and last functions that to the exact 
opposite of the head and tail, therefore not needing the function in reverse order -}

{-} The recursive function call with the where condition, is used to manage the increments
, given the sum of the last 2 indexes of the big number, if the sum is >= 10, we calculate use the 
div function that returns the integer value of those two numbers divided, given the increment for the next
operation and we concatenate to the end of the list, the mod operation of the sum -}

somaBNaux :: Int -> [Int] -> [Int] -> [Int]
somaBNaux 0 [] b = b
somaBNaux 0 a [] = a
somaBNaux inc [] [] = [inc]
somaBNaux inc a [] = somaBNaux (div sum' 10) (init a) [] ++ [mod sum' 10]
    where
        sum' = last a + inc 
somaBNaux inc [] b = somaBNaux (div sum'' 10) [] (init b) ++ [mod sum'' 10]
    where@
        sum'' = last b + inc
somaBNaux inc a b = somaBNaux (div sum''' 10) (init a) (init b) ++ [mod sum''' 10] {-} Recursive call to aux function, with carry management -}
    where 
        sum''' = last a + last b + inc

biggerBN :: [Int] -> [Int] -> Int
biggerBN [] [] = 7
biggerBN digitsA digitsB
    | digitsA == digitsB = 2
    | length digitsA > length digitsB = 0
    | length digitsB > length digitsA = 1
    | head digitsA > head digitsB = 0
    | head digitsB > head digitsA = 1 
    | otherwise = biggerBN (tail digitsA) (tail digitsB)


subBNaux :: Int -> [Int] -> [Int] -> [Int]@
subBNaux 0 [] b = b
subBNaux 0 a [] = a 
subBNaux inc [] [] = [inc]
subBNaux inc a [] = subBNaux  (abs (div sub' 10)) (init a) [] ++ [mod sub' 10]
    where @
        sub' = last a - inc
subBNaux inc [] b = subBNaux  (abs (div sub'' 10)) [] (init b) ++ [mod sub'' 10]
    where 
        sub'' = - last b - inc
subBNaux inc a b = dropWhile(==0) (subBNaux (abs (div sub''' 10)) (init a) (init b) ++ [mod sub''' 10])
    where 
        sub''' = last a - inc - last b


mulBNaux :: [Int] -> [Int] -> [Int]
mulBNaux [] _ = []
mulBNaux _ [0] = []
mulBNaux _ [] = []
mulBNaux digitsA digitsB = somaBNaux 0 digitsA (mulBNaux digitsA (subBNaux 0 digitsB [1]))

divBNaux :: [Int] -> [Int] -> [Int] -> ([Int], [Int])
divBNaux _ _ [0] = error "Diving by Zero"
divBNaux _ [0] _ = ([0],[0])
divBNaux a digitsA digitsB 
    | biggerBN digitsA digitsB == 1 = (a, digitsA)
    | otherwise = divBNaux (somaBNaux 0 a [1]) list digitsB
    where list = subBNaux 0 digitsA digitsB
