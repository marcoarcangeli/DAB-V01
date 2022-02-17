SELECT
    AlgCat.IdAlgCat,
    AlgCat.IdAlgCatPar,
    AlgCat.Nam,
    AlgCat.Descr,
    AlgCatPar.Nam AS AlgCatParNam
FROM
    AlgCat
LEFT OUTER JOIN AlgCatPar ON AlgCatPar.IdAlgCatPar = AlgCat.IdAlgCatPar
WHERE
    AlgCat.IdAlgCat IN('26')
ORDER BY
    AlgCat.Nam
	
--terget
SELECT
    AlgCat.IdAlgCat,
    AlgCat.IdAlgCatPar,
    AlgCat.Nam,
    AlgCat.Descr,
    AlgCatPar.Nam AS AlgCatParNam
FROM
    AlgCat AlgCat
LEFT OUTER JOIN AlgCat AlgCatPar ON AlgCatPar.IdAlgCat = AlgCat.IdAlgCatPar
WHERE
    AlgCat.IdAlgCat IN('26')
ORDER BY
    AlgCat.Nam;

-- old
SELECT
	p.IdAlgCat,
	p.IdAlgCatPar,
	pp.Nam AS AlgCatParNam,
	p.Nam,
	p.Descr
FROM
	AlgCat p
	LEFT OUTER JOIN AlgCat pp ON p.IdAlgCatPar = pp.IdAlgCat
where p.IdAlgCat='26';

AlgCatRead_AlgCatParNam